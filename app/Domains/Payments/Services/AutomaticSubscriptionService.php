<?php
namespace App\Domains\Payments\Services;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Payments\Dtos\Stripe\InvoiceDto;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Subscription;
use Illuminate\Support\Facades\Log;

class AutomaticSubscriptionService
{
    protected UserRepository $userRepository;
    protected SubscriptionRepository $subscriptionRepository;

    public function __construct(UserRepository $userRepository, SubscriptionRepository $subscriptionRepository)
    {
        $this->userRepository = $userRepository;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function trySubscribe(InvoiceDto $dto): ?Subscription
    {
        if (!$this->isAutomaticSubscriptionPayment($dto)) {
            Log::info('Unrecognized product: ' . $dto->getProductId());

            return null;
        }

        $user = $this->userRepository->findByEmailOrCreate($dto->getEmail());
        if ($user === null) {
            Log::info('Wrong user: ' . $dto->getEmail());

            return null;
        }

        $user->update([
            'name' => $dto->getName(),
        ]);

        $subscription = $this->subscriptionRepository->create($user);

        $subscription->update([
            'stripe_plan_id'         => $dto->getPlanId(),
            'stripe_subscription_id' => $dto->getSubscriptionId(),
            'amount'                 => $dto->getPlanAmount(),
        ]);

        $this->subscriptionRepository->activateOrProlongFromStripe($dto);

//        event(new AutomaticSubscriptionStartedEvent($subscription));

        try {
            app(MailerliteService::class)->addUserToGroup($user, setting(SettingsHelper::STRIPE_MAILERLITE));
        } catch (\Exception $exception) {
            Log::error('MAILERLITE EXCEPTION ' . $exception->getMessage());
        }

        return $subscription;
    }

    protected function isAutomaticSubscriptionPayment(InvoiceDto $dto): bool
    {
        return in_array($dto->getProductId(), config('stripe.automatic.subscription'));
    }
}
