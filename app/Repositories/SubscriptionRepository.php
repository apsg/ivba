<?php
namespace App\Repositories;

use App\Coupon;
use App\Domains\Payments\Dtos\Stripe\InvoiceDto;
use App\Events\SubscriptionCancelled;
use App\Events\SubscriptionProlongedEvent;
use App\Events\SubscriptionStartedEvent;
use App\Payments\Exceptions\PaymentException;
use App\Payments\Exceptions\UnknownSubscriptionException;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class SubscriptionRepository
{
    protected $daysRepository;

    public function __construct()
    {
        $this->daysRepository = app(AccessDaysRepository::class);
    }

    public function create(User $user, Coupon $coupon = null): Subscription
    {
        $this->cancelAllSubscriptions($user);

        $amount = setting('ivba.subscription_price');
        if ($coupon !== null) {
            $amount = $coupon->apply($amount);
        }

        return Subscription::create([
            'user_id'   => $user->id,
            'coupon_id' => $coupon->id ?? null,
            'amount'    => $amount,
        ]);
    }

    public function cancel(Subscription $subscription): Subscription
    {
        $subscription->update([
            'cancelled_at' => Carbon::now(),
            'is_active'    => false,
            'token'        => null,
        ]);

        event(new SubscriptionCancelled($subscription));

        return $subscription;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function cancelAllSubscriptions(User $user): Collection
    {
        $user->subscriptions()->update([
            'cancelled_at' => Carbon::now(),
            'is_active'    => false,
            'token'        => null,
        ]);

        $user->subscriptions->each(function (Subscription $subscription) {
            event(new SubscriptionCancelled($subscription));
        });

        return $user->subscriptions;
    }

    public function makeActive(
        Subscription $subscription,
        string $token = null
    ): Subscription {
        if (empty($token)) {
            throw new PaymentException('Missing card token or stripe subscription');
        }

        $validUntil = Carbon::now();

        if (!empty($token)) {
            $validUntil = $validUntil->addDays(setting('ivba.subscription_duration_first'));
        }

        $subscription->update([
            'is_active'   => true,
            'token'       => $token,
            'valid_until' => $validUntil,
        ]);

        if ($subscription->coupon !== null) {
            $subscription->coupon->use();
        }

        $this->daysRepository->sync($subscription->user, $subscription->valid_until);

        event(new SubscriptionStartedEvent($subscription));

        return $subscription;
    }

    public function grantAccessDays(Subscription $subscription, int $days, bool $active = false)
    {
        $subscription->update([
            'is_active'   => $active,
            'valid_until' => Carbon::now()->addDays($days),
        ]);

        $this->daysRepository->sync($subscription->user, $subscription->valid_until);

        return $subscription;
    }

    public function prolong(Subscription $subscription): Subscription
    {
        if (!$subscription->isActive()) {
            throw new InvalidArgumentException("Subscription {$subscription->id} was cancelled {$subscription->cancelled_at}");
        }

        $valid = max($subscription->valid_until->timestamp, Carbon::now()->timestamp);

        $subscription->update([
            'valid_until' => Carbon::createFromTimestamp($valid)->addMonths(config('ivba.subscription_duration')),
            'tries'       => 0,
        ]);

        $subscription->load('user');

        $this->daysRepository->sync($subscription->user, $subscription->valid_until);

        event(new SubscriptionProlongedEvent($subscription));

        return $subscription;
    }

    public function tryFailed(Subscription $subscription)
    {
        if ($subscription->tries < 3) {
            $subscription->update([
                'tries' => $subscription->tries + 1,
            ]);

            return $subscription;
        }

        return $this->cancel($subscription);
    }

    public function activateOrProlongFromStripe(InvoiceDto $invoiceDto): Subscription
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::where('stripe_subscription_id', $invoiceDto->getSubscriptionId())->first();

        if ($subscription === null) {
            Log::info('Unknown subscription');

            throw new UnknownSubscriptionException($invoiceDto->getSubscriptionId());
        }

        $isFirstPayment = !$subscription->isActive();

        $subscription->update([
            'is_active'              => true,
            'stripe_subscription_id' => $invoiceDto->getSubscriptionId(),
            'valid_until'            => $invoiceDto->getPeriodEnd(),
        ]);

        $this->daysRepository->sync($subscription->user, $subscription->valid_until);

        if ($invoiceDto->getAmount() > 0) {
            $subscription->payments()->create([
                'title'        => config('ivba.subscription_description'),
                'amount'       => $invoiceDto->getAmount(),
                'external_id'  => $invoiceDto->getInvoiceId(),
                'confirmed_at' => Carbon::now(),
                'is_recurrent' => true,
            ]);
        }

        if ($isFirstPayment === true) {
            event(new SubscriptionStartedEvent($subscription));
        } else {
            event(new SubscriptionProlongedEvent($subscription));
        }

        return $subscription;
    }
}
