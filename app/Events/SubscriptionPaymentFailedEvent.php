<?php
namespace App\Events;

use App\Payment;

class SubscriptionPaymentFailedEvent
{
    /** @var Payment */
    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
