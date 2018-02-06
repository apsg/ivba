<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRecurringPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wykrywa i wykonuje kolejne płatności';

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
        $ph = new \App\Helpers\Payment;
        
        $subscriptions = \App\Subscription::where('next_payment_at', '<=', \Carbon\Carbon::now()->format('Y-m-d'))
            ->where('is_active', true)
            ->whereNull('cancelled_at')
            ->get();

        foreach ($subscriptions as  $subscription) {
            
            $subscription->update([
                'tries' => $subscription->tries + 1,
            ]);

            $order = \App\Order::create([
                'user_id'   => $subscription->user->id,
                'price'     => $subscription->amount,
                'duration'  => $subscription->duration,
                'description' => config('ivba.subscription_description'),
            ]);

            $result = $ph->recurring($order);

            if($result->status->statusCode == 'SUCCESS' ){
                $order->confirm();
                $order->user->notify( new \App\Notifications\SubscriptionPaid($subscription->fresh()) );
            }else{
                if($subscription->tries > 3)
                    $subscription->cancel();
            }

        }

    }
}
