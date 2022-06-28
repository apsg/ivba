<?php
namespace App\Console\Commands;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProlongSubscriptionsCommand extends Command
{
    protected $signature = 'subscriptions:prolong';
    protected $description = 'Prolong active subscriptions that have expired';

    public function handle()
    {
        \Log::info('Trying to prolong subscriptions');

        $subscriptions = Subscription::active()
            ->where('valid_until', '<', Carbon::now())
            ->get();

        $count = $subscriptions->count();

        \Log::info("Prolonging {$count} subscriptions");

        foreach ($subscriptions as $subscription) {
            event(new ActiveSubscriptionExpiredEvent($subscription));
        }
    }
}
