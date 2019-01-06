<?php
namespace App\Payments;

use App\Payment;
use App\Payments\Tpay\CardPaymentGate;
use App\User;

class PaymentService
{
    public function payUrl(Payment $payment, User $user)
    {
        return (new CardPaymentGate())->getRedirectTransaction($payment, $user);
    }
}