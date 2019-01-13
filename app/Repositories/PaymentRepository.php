<?php
namespace App\Repositories;

use App\Payment;
use App\Subscription;

class PaymentRepository
{
    public function createFirst(Subscription $subscription)
    {
        return Payment::create([
            'subscription_id' => $subscription->id,
            'amount'          => config('ivba.subscription_price_first'),
            'is_recurrent'    => false,
            'title'           => config('ivba.subscription_description_first'),
        ]);
    }

    public function createRecurrent(Subscription $subscription)
    {
        return Payment::create([
            'subscription_id' => $subscription->id,
            'amount'          => config('ivba.subscription_price'),
            'is_recurrent'    => true,
            'title'           => config('ivba.subscription_description'),
        ]);
    }
}