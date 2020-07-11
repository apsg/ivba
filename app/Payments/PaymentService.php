<?php
namespace App\Payments;

use App\Payment;
use App\Payments\Tpay\CardPaymentGate;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentService
{
    public function payUrl(Payment $payment)
    {
        if (! Auth::user()->can('pay', $payment)) {
            throw  new AuthorizationException('You do not have access to process this payment');
        }

        return (new CardPaymentGate())->getRedirectTransaction($payment, $payment->subscription->user);
    }
}
