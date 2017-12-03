<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiscoverLeftOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $start = \Carbon\Carbon::now()->subDays(2);
        $end = \Carbon\Carbon::now()->subDays(1);

        $orders = \App\Order::where('updated_at', '>=', $start)
            ->where('updated_at', '<', $end)
            ->whereNotNull('payu_order_id')
            ->whereNUll('confirmed_at')
            ->get();

        foreach ($orders as $order) {
            event(new \App\Events\OrderLeft24hAgo($order));
        }

        $start = \Carbon\Carbon::now()->subDays(4);
        $end = \Carbon\Carbon::now()->subDays(3);

        $orders = \App\Order::where('updated_at', '>=', $start)
            ->where('updated_at', '<', $end)
            ->whereNotNull('payu_order_id')
            ->whereNUll('confirmed_at')
            ->get();

        foreach ($orders as $order) {
            event(new \App\Events\OrderLeft72hAgo($order));
        }
    }
}
