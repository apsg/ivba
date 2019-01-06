<?php
namespace App\Payments\Tpay\Traits;

trait TpayCardConstructorTrait
{
//    public function __construct()
//    {
//        $env = config('tpay.default');
//
//        $this->cardApiKey = config("tpay.{$env}.card.key");
//        $this->cardApiPass = config("tpay.{$env}.card.pass");
//        $this->cardKeyRSA = config("tpay.{$env}.card.rsa");
//        $this->cardVerificationCode = config("tpay.{$env}.card.verification_code");
//        $this->cardHashAlg = 'sha1';
//        parent::__construct();
//    }

    public function __construct()
    {
        $this->cardApiKey = 'bda5eda723bf1ae71a82e90a249803d3f852248d';
        $this->cardApiPass = 'IhZVgraNcZoWPLgA';
        $this->cardKeyRSA = 'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0NCk1JR2ZNQTBHQ1NxR1NJYjNEUUVCQVFVQUE0R05BRENCaVFLQmdRQ2NLRTVZNU1Wemd5a1Z5ODNMS1NTTFlEMEVrU2xadTRVZm1STS8NCmM5L0NtMENuVDM2ekU0L2dMRzBSYzQwODRHNmIzU3l5NVpvZ1kwQXFOVU5vUEptUUZGVyswdXJacU8yNFRCQkxCcU10TTVYSllDaVQNCmVpNkx3RUIyNnpPOFZocW9SK0tiRS92K1l1YlFhNGQ0cWtHU0IzeHBhSUJncllrT2o0aFJDOXk0WXdJREFRQUINCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ';
        $this->cardVerificationCode = '6680181602d396e640cb091ea5418171';
        $this->cardHashAlg = 'sha1';
        parent::__construct();
    }
}