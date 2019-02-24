<?php

namespace App\Console\Commands;

use App\Events\OrderLeft24hAgo;
use App\Events\OrderLeft72hAgo;
use App\Order;
use Carbon\Carbon;
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
        $start = Carbon::now()->subDays(2);
        $end = Carbon::now()->subDays(1);

        $orders = Order::where('updated_at', '>=', $start)
            ->where('updated_at', '<', $end)
            ->whereNotNull('external_payment_id')
            ->whereNUll('confirmed_at')
            ->get();

        foreach ($orders as $order) {
            event(new OrderLeft24hAgo($order));
        }

        $start = Carbon::now()->subDays(4);
        $end = Carbon::now()->subDays(3);

        $orders = Order::where('updated_at', '>=', $start)
            ->where('updated_at', '<', $end)
            ->whereNotNull('external_payment_id')
            ->whereNUll('confirmed_at')
            ->get();

        foreach ($orders as $order) {
            event(new OrderLeft72hAgo($order));
        }
    }
}
