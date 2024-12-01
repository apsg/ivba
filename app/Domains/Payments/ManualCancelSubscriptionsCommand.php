<?php
namespace App\Domains\Payments;

use App\Payments\Drivers\StripeDriver;
use App\Payments\PaymentService;
use App\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;

class ManualCancelSubscriptionsCommand extends Command
{
    protected $signature = 'subscriptions:cancel {days?}';

    protected $description = 'Cancel subscriptions in Stripe';

    /**
     * @var StripeDriver
     */
    protected $stripe;

    public function __construct()
    {
        parent::__construct();

        if (PaymentService::isDriverStripe() && PaymentService::hasStripeConfig()) {
            $this->stripe = app(StripeDriver::class);
        }
    }

    public function handle()
    {
        if ($this->stripe === null) {
            return;
        }

        $days = (int) $this->argument('days') ?? 1;

        $subscriptions = Subscription::whereNotNull('stripe_subscription_id')
            ->whereNotNull('cancelled_at')
            ->where('cancelled_at', '>', now()->subDays($days))
            ->get();

        foreach ($subscriptions as $subscription) {
            try {
                $this->stripe->cancelSubscription($subscription);
            } catch (ApiErrorException $exception) {
                // probably no such subscription

                Log::info('STRIPE CANCEL EXCEPTION', [
                    'message'         => $exception->getMessage(),
                    'subscription_id' => $subscription->id,
                    'stripe_id'       => $subscription->stripe_subscription_id,
                ]);
            }
        }
    }
}
