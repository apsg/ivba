<?php
namespace App\Payments\Tpay;

use App\Payment;
use App\Payments\Exceptions\PaymentException;
use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use App\Repositories\PaymentRepository;
use tpayLibs\src\_class_tpay\PaymentCard;
use tpayLibs\src\_class_tpay\Utilities\TException;

class RecurrentPaymentGate extends PaymentCard
{
    use TpayCardConstructorTrait;

    private $transactionId = null;

    /** @var Payment */
    private $payment;

    /**
     * @param string  $saleDescription
     * @param string  $clientToken
     * @param Payment $payment
     * @return $this
     * @throws PaymentException
     * @throws TException
     */
    public function init(
        string $saleDescription = null,
        string $clientToken = null,
        Payment $payment = null
    ) {
        if ($clientToken === null || $payment === null) {
            throw new PaymentException('Missing token or payment');
        }

        $saleDescription = $saleDescription ?? '';

        $this->payment = $payment;
        //Prepare transaction data
        $this
            ->setAmount($this->payment->amount)
            ->setCurrency(985)
            ->setOrderID($this->payment->id)
            ->setLanguage('pl')
            ->setClientToken($clientToken);
        //Prepare unpaid transaction

        try {
            $transaction = $this->presaleMethod($saleDescription);
            $this->transactionId = $transaction['sale_auth'];

            return $this;
        } catch (TException $exception) {
            throw new PaymentException($exception->getMessage());
        }
    }

    /**
     * @return Payment
     * @throws PaymentException
     * @throws TException
     */
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