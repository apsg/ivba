<?php
namespace App\Payments;

use App\Payment;
use App\Payments\Drivers\StripeDriver;
use App\Payments\Exceptions\UnknownSubscriptionProviderException;
use App\Payments\Tpay\CardPaymentGate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    const DRIVER_TPAY = 'tpay';
    const DRIVER_STRIPE = 'stripe';

    public function payUrl(Payment $payment): string
    {
        if (!Auth::user()->can('pay', $payment)) {
            throw  new AuthorizationException('You do not have access to process this payment');
        }

        switch (config('subscriptions.provider')) {
            case static::DRIVER_TPAY:
            {
                return (new CardPaymentGate())->getRedirectTransaction($payment, $payment->subscription->user);
            }
            case static::DRIVER_STRIPE:
            {
                return app(StripeDriver::class)->createSubscriptionLink($payment);
            }
            default:
            {
                throw new UnknownSubscriptionProviderException(config('subscriptions.provider'));
            }
        }
    }

    public static function isDriverStripe(): bool
    {
        return config('subscriptions.provider') === static::DRIVER_STRIPE;
    }

    public static function isDriverTpay(): bool
    {
        return config('subscriptions.provider') === static::DRIVER_TPAY;
    }
}
