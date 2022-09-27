<?php
namespace App\Console\Commands;

use App\Helpers\PayuPayment;
use App\Notifications\SubscriptionPaid;
use App\Order;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MakeRecurringPayments extends Command
{
    protected $signature = 'ivba:recurring';
    protected $description = 'Wykrywa i wykonuje kolejne płatności';

    public function handle()
    {
        $ph = new PayuPayment;

        $subscriptions = Subscription::where('next_payment_at', '<=', Carbon::now()->format('Y-m-d'))
            ->where('is_active', true)
            ->whereNull('cancelled_at')
            ->get();

        foreach ($subscriptions as $subscription) {
            $subscription->update([
                'tries' => $subscription->tries + 1,
            ]);

            $order = Order::create([
                'user_id'     => $subscription->user->id,
                'price'       => $subscription->amount,
                'duration'    => $subscription->duration,
                'description' => config('ivba.subscription_description'),
            ]);

            $result = $ph->recurring($order);

            if ($result->status->statusCode == 'SUCCESS') {
                $order->confirm();
                $order->user->notify(new SubscriptionPaid($subscription->fresh()));
            } else {
                if ($subscription->tries > 3) {
                    $subscription->cancel();
                }
            }
        }
    }
}
