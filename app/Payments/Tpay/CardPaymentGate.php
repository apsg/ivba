<?php
namespace App\Payments\Tpay;

use App\Payment;
use App\Payments\Exceptions\PaymentException;
use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use App\User;
use tpayLibs\src\_class_tpay\PaymentCard;
use tpayLibs\src\_class_tpay\Utilities\TException;

class CardPaymentGate extends PaymentCard
{
    use TpayCardConstructorTrait;

    public function getRedirectTransaction(Payment $payment, User $user)
    {
        try {
            $this
                ->setAmount($payment->amount)
                ->setCurrency(985)
                ->setOrderID((string)$payment->id)
                ->setReturnUrls(url('/tpay/success'), url('/tpay/error'))
                ->setOneTimer(false);

            $transaction = $this->registerSale($user->full_name, $user->email, $payment->title);

            if (isset($transaction['sale_auth']) === false) {
                throw new TException('Error generating transaction: ' . $transaction['err_desc']);
            }

            $transactionId = $transaction['sale_auth'];

            return "https://secure.tpay.com/cards/?sale_auth=$transactionId";
        } catch (TException $e) {
            throw new PaymentException('Payment failed: ' . $e->getMessage());
        }
    }
}