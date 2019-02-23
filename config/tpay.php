<?php

return [

    'card' => [
        'key'               => env('TPAY_KEY'),
        'pass'              => env('TPAY_PASS'),
        'rsa'               => env('TPAY_RSA'),
        'verification_code' => env('TPAY_VERIFICATION'),
    ],

    'transaction' => [
        'id'       => env('TPAY_ID', 1010),
        'secret'   => env('TPAY_SECRET', 'demo'),
        'api_key'  => env('TPAY_API_KEY', '75f86137a6635df826e3efe2e66f7c9a946fdde1'),
        'api_pass' => env('TPAY_API_PASS', 'p@$$w0rd#@!'),
    ],
];