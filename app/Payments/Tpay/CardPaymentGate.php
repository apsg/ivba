<?php
namespace App\Payments\Tpay;

use tpayLibs\src\_class_tpay\PaymentForms\PaymentCardForms;

class CardPaymentGate extends PaymentCardForms
{
    public function __construct()
    {
        $this->cardApiKey = config('tpay.card.key');
        $this->cardApiPass = config('tpay.card.pass');
        $this->cardKeyRSA = config('tpay.card.rsa');
        $this->cardVerificationCode = config('tpay.card.verification_code');
        $this->cardHashAlg = 'sha1';
        parent::__construct();
    }

    public function init()
    {
        return $this->getOnSiteCardForm(url('tpay/payment'));
    }

}