<?php
namespace App\Payments\Drivers;

use App\Payments\Exceptions\InvalidCardException;
use SoapClient;

class P24Driver
{
    const SANDBOX_URL = 'https://sandbox.przelewy24.pl';

    const PRODUCTION_URL = 'https://secure.przelewy24.pl';

    /** @var string */
    protected $baseUrl;

    /** @var string */
    protected $merchantId;

    /** @var string */
    protected $secret;

    /** @var SoapClient */
    protected $soap;

    public function __construct()
    {
        if (config('przelewy24.sandbox') === true) {
            $this->baseUrl = static::SANDBOX_URL;
        } else {
            $this->baseUrl = static::PRODUCTION_URL;
        }

        $this->merchantId = config('przelewy24.merchant_id');
        $this->secret = config('przelewy24.secret');

        $this->soap = new SoapClient($this->baseUrl . "/external/wsdl/charge_card_service.php?wsdl");
    }

    public function testConnection() : bool
    {
        $url = $this->baseUrl . "/external/{$this->merchantId}.wsdl";

        $soap = new SoapClient($url);

        $test = $soap->testAccess($this->merchantId, $this->secret);

        if ($test) {
            return true;
        }

        return false;
    }

    public function checkCard($cardToken)
    {
        $result = $this->soap->CheckCard($this->merchantId, $this->secret, $cardToken);

        if ($result->error->errorCode === 0) {
            return $result->result;
        } else {
            throw new InvalidCardException("Card is not valid for recurring transactions. " . $result->error->errorMessage);
        }

    }

    protected function getCrc($amount)
    {

    }
}