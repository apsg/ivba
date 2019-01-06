<?php
namespace App\Payments\Tpay;

use App\Payments\Tpay\Traits\TpayCardConstructorTrait;
use App\User;
use tpayLibs\src\_class_tpay\PaymentCard;
use tpayLibs\src\_class_tpay\Utilities\TException;

class CardPaymentGate extends PaymentCard
{
    use TpayCardConstructorTrait;

    public function getRedirectTransaction(User $user)
    {
        try {
            $config = [
                'name'  => $user->full_name,
                'email' => $user->email,
                'desc'  => 'Pierwsza płatność dla subskrypcji na ' . config('app.name'),
            ];

            $this
                ->setAmount(config('ivba.subscription_price_first'))
                ->setCurrency(985)
                ->setOrderID((string)$user->getCurrentOrder()->id)
                ->setReturnUrls(url('/tpay/success'), url('/tpay/error'));

            $transaction = $this->registerSale($config['name'], $config['email'], $config['desc']);

            if (isset($transaction['sale_auth']) === false) {
                throw new TException('Error generating transaction: ' . $transaction['err_desc']);
            }

            $transactionId = $transaction['sale_auth'];

            return "https://secure.tpay.com/cards/?sale_auth=$transactionId";
        } catch (TException $e) {
            echo 'Unable to generate transaction. Reason: ' . $e->getMessage();
        }
    }
}