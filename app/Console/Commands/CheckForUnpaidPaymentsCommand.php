<?php

namespace App\Console\Commands;

use App\Subscription;
use Illuminate\Console\Command;

class CheckForUnpaidPaymentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for unpaid subscriptions';

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
        $unpaidSubscriptions = Subscription::whereNull('valid_until')
            ->whereNull('cancelled_at')
            ->get();
    }
}
