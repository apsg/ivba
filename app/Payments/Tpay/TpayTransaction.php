<?php
namespace App\Payments\Tpay;

use App\Order;
use tpayLibs\src\_class_tpay\TransactionApi;
use tpayLibs\src\_class_tpay\Utilities\TException;

class TpayTransaction extends TransactionApi
{
    /** @var string */
    private $trId;

    /** @var Order */
    protected $order;

    public function __construct(Order $order)
    {
        $this->merchantSecret = config('tpay.transaction.secret');
        $this->merchantId = config('tpay.transaction.id');
        $this->trApiKey = config('tpay.transaction.api_key');
        $this->trApiPass = config('tpay.transaction.api_pass');

        $this->order = $order;

        parent::__construct();
    }

    public function createTransaction()
    {
        $config = [
            'amount'       => $this->order->total(),
            'description'  => 'Zamówienie numer #' . $this->order->id . ' w systemie ' . config('app.name'),
            'crc'          => $this->order->id . '|' . uniqid(),
            'result_url'   => $this->getIpnUrl(),
            'result_email' => 'gacek@pasterzdrzew.pl',
            'return_url'   => url('/tpay/success'),
            'email'        => $this->order->user->email,
            'name'         => $this->order->user->full_name,
            'group'        => isset($_POST['group']) ? (int)$_POST['group'] : 150,
            'accept_tos'   => 1,
        ];

        try {
            $res = $this->create($config);
            $this->trId = $res['title'];

            return 'https://secure.tpay.com/?gtitle=' . $this->trId;
        } catch (TException $e) {
            \Log::info('Transaction creation problem', [
                'order'   => $this->order,
                'message' => $e->getMessage(),
            ]);

            flash($e->getMessage());

            return url('/cart');
        }
    }

    protected function getIpnUrl() : string
    {
        if (app()->environment() === 'production') {
            return url('/tpay/ipn');
        }

        return 'http://53100be8.ngrok.io/tpay/ipn';
    }

}