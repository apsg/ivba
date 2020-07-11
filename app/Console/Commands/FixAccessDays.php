<?php

namespace App\Console\Commands;

use App\Repositories\AccessDaysRepository;
use App\Subscription;
use Illuminate\Console\Command;

class FixAccessDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:fix_access_days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix access days';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subscriptions = Subscription::where('is_active', true)->get();

        foreach ($subscriptions as $subscription) {
            app(AccessDaysRepository::class)
                ->sync($subscription->user,
                    $subscription->valid_until,
                    $subscription->created_at);
        }
    }
}
