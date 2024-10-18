<?php
namespace App\Domains\Payments;

use App\Payments\Drivers\StripeDriver;
use App\Subscription;
use Illuminate\Console\Command;

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

        $this->stripe = app(StripeDriver::class);
    }

    public function handle()
    {
        $days = (int) $this->argument('days') ?? 1;

        $subscriptions = Subscription::whereNotNull('stripe_subscription_id')
            ->whereNotNull('cancelled_at')
            ->where('cancelled_at', '>', now()->subDays($days))
            ->get();

        foreach ($subscriptions as $subscription) {
            $this->stripe->cancelSubscription($subscription);
        }
    }
}
