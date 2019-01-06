<?php
namespace App\Payments\Tpay;

use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use tpayLibs\src\_class_tpay\PaymentCard;
use tpayLibs\src\_class_tpay\Utilities\TException;
use tpayLibs\src\_class_tpay\Validators\PaymentTypes\PaymentTypeCard;
use tpayLibs\src\_class_tpay\Validators\PaymentTypes\PaymentTypeCardDeregister;
use tpayLibs\src\Dictionaries\CardDictionary;

class CardNotification extends PaymentCard
{
    use TpayCardConstructorTrait;

    public function handleNotification(string $notificationType)
    {
        if ($notificationType === CardDictionary::SALE) {
            $response = $this->getResponse(new PaymentTypeCard());
        } elseif ($notificationType === CardDictionary::DEREGISTER) {
            $response = $this->getResponse(new PaymentTypeCardDeregister());
        } else {
            throw new TException('Unknown notification type');
        }
        if ($this->validateServerIP === true && $this->isTpayServer() === false) {
            throw new TException('Request is not from secure server');
        }

        echo json_encode([CardDictionary::RESULT => '1']);

        if (($notificationType === CardDictionary::SALE && $response['status'] === 'correct')
            || $notificationType === CardDictionary::DEREGISTER
        ) {
            if (isset($response[CardDictionary::CLIAUTH])) {
                $this->setClientToken($response[CardDictionary::CLIAUTH]);
            }
        } else {
            throw new TException('Incorrect payment');
        }

        return $response;
    }


    private function getTpayNotification()
    {
        //Jeżeli chcesz wyłączyć sprawdzanie adresu IP serwera Tpay, wykonaj tą komendę:
        $this->disableValidationServerIP();
        //Jeżeli korzystasz z proxy, wykonaj tą komendę aby sprawdzić adres IP w tablicy HTTP_X_FORWARDED_FOR:
//        $this->enableForwardedIPValidation();

        $notification = $this->handleNotification();

        $shopOrderData = $this->getOrderDetailsFromDatabase($notification['order_id']);

        $this
            ->setAmount($shopOrderData['amount'])
            ->setCurrency($shopOrderData['currency'])
            ->setOrderID($notification['order_id']);
        $this->validateCardSign($notification['sign'], $notification['sale_auth'],
            $notification['card'], $notification['date'], $notification['status']);

        return $notification;
    }

    private function getOrderDetailsFromDatabase($order_id) : array
    {
        return [];
    }
}