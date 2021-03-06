<?php
namespace App\Helpers;

use App\Order;
use Illuminate\Support\Facades\Auth;
use OpenPayU_Configuration;
use OpenPayU_Order;

class PayuPayment
{
    public function __construct()
    {
        OpenPayU_Configuration::setEnvironment(config('payu.environment')); // sandbox

        //set POS ID and Second MD5 Key (from merchant admin panel)
        OpenPayU_Configuration::setMerchantPosId(config('payu.posid'));
        OpenPayU_Configuration::setSignatureKey(config('payu.key2'));

        //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
        OpenPayU_Configuration::setOauthClientId(config('payu.posid'));
        OpenPayU_Configuration::setOauthClientSecret(config('payu.key1'));
        OpenPayU_Configuration::setOauthTokenCache(new \OauthCacheFile(storage_path('cache')));
    }

    /**
     * Wygeneruj link przekierowujący do płatności.
     */
    public function getUrl(Order $order)
    {
        $payu['notifyUrl'] = url('/payu/notify');
        $payu['continueUrl'] = url('continue?order=' . $order->id);

        $payu['customerIp'] = request()->ip();
        $payu['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $payu['description'] = 'Zamówienie na ' . config('app.name');
        $payu['currencyCode'] = 'PLN';
        $payu['totalAmount'] = 100 * $order->total();
        $payu['extOrderId'] = $order->id . '_' . uniqid();

        $order->final_total = $order->total();
        $order->payu_order_id = $payu['extOrderId'];

        if ($order->is_full_access) {
            $payu['products'][] = $this->createFullAccessProduct($order);
        }

        if ($order->isQuickSales()) {
            $payu['products'][] = $this->createQuickSalesProduct($order);
        }

        $payu['buyer']['email'] = $order->user->email;

        $response = OpenPayU_Order::create($payu);
        $order->save();

        return $response->getResponse()->redirectUri;
    }

    /**
     * Pierwsza płatność cykliczna.
     * @return [type] [description]
     */
    public function first(Order $order, $token)
    {
        $payu['notifyUrl'] = url('/notify_recurring');
        $payu['continueUrl'] = url('/continue/' . $order->id);

        $payu['customerIp'] = request()->ip();
        $payu['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        // $payu['recurring'] = "STANDARD";
        $payu['description'] = config('ivba.subscription_description_first') . ' ' . Auth::user()->email;
        $payu['currencyCode'] = 'PLN';
        $payu['totalAmount'] = 100 * $order->total();
        $payu['extOrderId'] = $order->id . '_' . uniqid();

        $order->final_total = $order->total();
        $order->payu_order_id = $payu['extOrderId'];

        $payu['products'][0] = [
            'name'      => config('ivba.subscription_description_first'),
            'unitPrice' => 100 * $order->total(),
            'quantity'  => 1,
        ];

        $payu['buyer']['email'] = Auth::user()->email;

        $payu['payMethods'] = [
            'payMethod' => [
                'value' => $token,
                'type'  => 'CARD_TOKEN',
            ],
        ];

        $response = OpenPayU_Order::create($payu);

        $order->save();

        return $response->getResponse();
    }

    /**
     * [recurring description].
     * @param \App\Order $order [description]
     * @return [type]            [description]
     */
    public function recurring(Order $order)
    {
        $payu['notifyUrl'] = url('/notify_recurring');
        $payu['continueUrl'] = url('/continue/' . $order->id);

        $payu['customerIp'] = request()->ip();
        $payu['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $payu['recurring'] = 'STANDARD';
        $payu['description'] = config('ivba.subscription_description') . ' ' . $order->user->email;
        $payu['currencyCode'] = 'PLN';
        $payu['totalAmount'] = 100 * $order->total();
        $payu['extOrderId'] = $order->id . '_' . uniqid();

        $order->final_total = $order->total();
        $order->payu_order_id = $payu['extOrderId'];

        $payu['products'][0] = [
            'name'      => config('ivba.subscription_description'),
            'unitPrice' => 100 * $order->total(),
            'quantity'  => 1,
        ];

        $payu['buyer']['email'] = $order->user->email;

        $payu['payMethods'] = [
            'payMethod' => [
                'value' => $order->user->card_token,
                'type'  => 'CARD_TOKEN',
            ],
        ];

        $response = OpenPayU_Order::create($payu);

        $order->save();

        return $response->getResponse();
    }

    /**
     * Oblicza SIG dla payu (recurring payment).
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public static function sig($email, $amount)
    {
        $str = 'PLN'    // currency-code
            . $email    // customer-email
            . 'pl'        // customer-language
            . config('payu.posid')    // merchant-pos-id
            . 'true'                    // recurring-payment
            . config('app.name')        // shop-name
            . 'true'                    // store-card
            . $amount                // total-amount
            . config('payu.key2');   // MD5 - 2

        return hash('sha256', $str);
    }

    public function createFullAccessProduct(Order $order) : array
    {
        $item = [];
        $item['name'] = 'Pełny dostęp do platformy iVBA ' . $order->duration . ' dni';
        $item['unitPrice'] = 100 * $order->price;
        $item['quantity'] = 1;

        return $item;
    }

    public function createQuickSalesProduct(Order $order) : array
    {
        $item = [];
        $item['name'] = $order->quick_sales()->first()->name;
        $item['unitPrice'] = 100 * $order->total();
        $item['quantity'] = 1;

        return $item;
    }
}
