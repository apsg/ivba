<?php
namespace App\Payments\Tpay;

use App\Payments\Exceptions\PaymentException;
use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use tpayLibs\src\_class_tpay\PaymentForms\PaymentCardForms;
use tpayLibs\src\_class_tpay\Utilities\Util;
use tpayLibs\src\Dictionaries\FieldsConfigDictionary;

class OnSiteGate extends PaymentCardForms
{
    use TpayCardConstructorTrait;

    public function init()
    {
        //Show new payment form
        return $this->getOnSiteCardForm('/tpay/success');
    }

    public function process()
    {
        //Try to sale with provided card data
        $response = $this->makeCardPayment();
        //Successful payment by card not protected by 3DS
        if (isset($response['result']) && (int)$response['result'] === 1) {
            $this->setOrderAsComplete($response);

            return null;
        } elseif (isset($response['3ds_url'])) {
            return $response['3ds_url'];
        } else {
            //Invalid credit card data
            return $this->tryToSaleAgain();
        }
    }

    private function makeCardPayment($failOver = false)
    {
        $cardData = Util::post('carddata', FieldsConfigDictionary::STRING);
        $clientName = Util::post('client_name', FieldsConfigDictionary::STRING);
        $clientEmail = Util::post('client_email', FieldsConfigDictionary::STRING);
        $saveCard = Util::post('card_save', FieldsConfigDictionary::STRING);
        Util::log('Secure Sale post params', print_r($_POST, true));
//        if ($saveCard === 'on') {
        $this->setOneTimer(false);
//        }
        $this->setAmount(123)->setCurrency(985)->setOrderID('test payment 123');
        $this->setLanguage('pl')->setReturnUrls(url('/tpay/success'), url('/tpay/error'));

        return $failOver === false ?
            $this->registerSale($clientName, $clientEmail, 'test sale', $cardData) :
            $this->setCardData(null)->registerSale($clientName, $clientEmail, 'test sale');
    }

    private function setOrderAsComplete($params)
    {
        var_dump($params);
    }

    private function tryToSaleAgain() : string
    {
        //Try to create new transaction and redirect customer to Tpay transaction panel
        $response = $this->makeCardPayment(true);
        if (isset($response['sale_auth'])) {
            return 'https://secure.tpay.com/cards/?sale_auth=' . $response['sale_auth'];
        } else {
            throw new PaymentException($response['err_desc']);
        }
    }
}
