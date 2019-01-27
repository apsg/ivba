<?php
namespace App\Payments\Tpay;

use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use tpayLibs\src\_class_tpay\PaymentCard;

class RecurrentPaymentGate extends PaymentCard
{
    use TpayCardConstructorTrait;

    private $transactionId = null;

    public function init(
        $saleDescription,
        $clientToken,
        $amount,
        $orderId = null,
        $currency = 985,
        $language = 'pl'
    ) {
        //Prepare transaction data
        $this
            ->setAmount($amount)
            ->setCurrency($currency)
            ->setOrderID($orderId)
            ->setLanguage($language)
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
            return $this->setOrderAsConfirmed();
        } else {
            //Log rejection code
            return $result['reason'];
        }
    }

    private function setOrderAsConfirmed()
    {
        //Code updating order ($this->orderID) status as paid at your DB
        //Save transaction ID for later use
    }

}

(new RecurrentPayment())
    ->init('payment for order xyz', 't5a96d292cd0a5c63a14c30adeae55cb200df087', 12.50, 'order_123456', 985, 'pl')
    ->payBySavedCreditCard();
