<?php

namespace App\Console\Commands;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProlongSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:prolong';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prolong active subscriptions that have expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subscriptions = Subscription::where('is_active', true)
            ->where('valid_until', '<', Carbon::now())
            ->get();

        foreach ($subscriptions as $subscription) {
            event(new ActiveSubscriptionExpiredEvent($subscription));
        }
    }
}
