<?php
namespace App\Console\Commands;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProlongSubscriptionsCommand extends Command
{
    protected $signature = 'subscriptions:prolong';
    protected $description = 'Prolong active subscriptions that have expired';

    public function handle()
    {
        $subscriptions = Subscription::active()
            ->notStripe()
            ->where('valid_until', '<', Carbon::now())
            ->get();

        $count = $subscriptions->count();

        if ($count > 0) {
            Log::info("Prolonging {$count} subscriptions");
        }

        foreach ($subscriptions as $subscription) {
            event(new ActiveSubscriptionExpiredEvent($subscription));
        }
    }
}
