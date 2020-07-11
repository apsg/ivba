<?php
namespace App\Payments\Tpay;

use tpayLibs\src\_class_tpay\Notifications\BasicNotificationHandler;

class TransactionNotification extends BasicNotificationHandler
{
    public function __construct()
    {
        $this->merchantSecret = config('tpay.transaction.secret');
        $this->merchantId = (int) config('tpay.transaction.id');
        parent::__construct();
    }

    /*
         * Example $paymentDetails response
        Array
        (
            [id] => 12345
            [tr_id] => TR-B7K-79FR0X
            [tr_date] => 2015-07-22 08:45:23
            [tr_crc] => order_200
            [tr_amount] => 40.96
            [tr_paid] => 40.96
            [tr_desc] => Sklep tpay.com
            [tr_status] => TRUE
            [tr_error] => none
            [tr_email] => kowalsky@example.com
            [test_mode] => 1
            [md5sum] => 0d1cf3083e2fe3b49d046c28e28d120c
        )
         */
}
