<?php
namespace App\Payments\Tpay\Traits;

trait TpayCardConstructorTrait
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
}
