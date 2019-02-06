<?php
namespace App\Payments\Tpay;

use App\Payment;
use App\Payments\Exceptions\PaymentException;
use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use App\Repositories\PaymentRepository;
use tpayLibs\src\_class_tpay\PaymentCard;

class RecurrentPaymentGate extends PaymentCard
{
    use TpayCardConstructorTrait;

    private $transactionId = null;

    /** @var Payment */
    private $payment;

    public function init(
        string $saleDescription,
        string $clientToken,
        Payment $payment
    ) {

        $this->payment = $payment;
        //Prepare transaction data
        $this
            ->setAmount($this->payment->amount)
            ->setCurrency(985)
            ->setOrderID($this->payment->id)
            ->setLanguage('pl')
            ->setClientToken($clientToken);
        //Prepare unpaid transaction
        $transaction = $this->presaleMethod($saleDescription);
        $this->transactionId = $transaction['sale_auth'];

        return $this;
    }

    public function payBySavedCreditCard()
    {
        //Try to execute payment
        //In test mode this method has 50% probability of success
        $result = $this->saleMethod($this->transactionId);
        
        if (isset($result['status']) && $result['status'] === 'correct') {
            return $this->confirmPayment();
        } else {
            app(PaymentRepository::class)
                ->rejectRecurrent($this->payment, array_get($result, 'reason'));
            throw new PaymentException("Payment failed: " . array_get($result, 'reason'));
        }
    }

    private function confirmPayment()
    {
        return app(PaymentRepository::class)
            ->confirmRecurrent($this->payment);
    }

}