<?php
namespace App\Payments\Tpay;

use tpayLibs\src\_class_tpay\PaymentForms\PaymentBasicForms;

class TpayMethodSelector extends PaymentBasicForms
{
    public function __construct()
    {
        $this->merchantSecret = config('tpay.transaction.secret');
        $this->merchantId = (int)config('tpay.transaction.id');
        parent::__construct();
    }

    public function getBankForm(string $url)
    {
        return $this->getBankSelectionForm([], false, false, $url);
    }
}