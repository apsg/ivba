<?php

return [
    'mode'    => 'live',
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'm.grabowski-facilitator@itbt.pl'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'MML3W5W9R6R3DBXT'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET',
            'EJQ2joMpuFsPL7sknDNHjaZK5SfLktHrFg_qAsmsfxchruioP0n16D7GE7-1zDFK1vdTfYGiIebaWcCH'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'ARDPkU14lW8iirHNtpZ4kuRwtGrlzjX6_xCkDOpkwibOLcDPfbl7tGGkokmL7JItMExctVEZCpoyv6kM',
    ],
    'live'    => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', 'm.grabowski@itbt.pl'),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', 'hrvdupa498'),
        'secret'      => env('PAYPAL_LIVE_API_SECRET',
            'EJtj0MqwAFhQ5Kr668Wm5JJ7-QJGZGo9j3KmPDPtYrmDWHd8C-oJTNbRzLLQfW82FfM09e3A_bZUlLUN'),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => 'AbKs5x4oqo28dLYBAqiP0j6TMdDBlOg1qRqM-KywP1x0qU88yYOGP9bdEwQaaIT2OqQV5d-vHnFChwUH',
    ],

    'payment_action' => 'Sale',
    'currency'       => 'PLN',
    'notify_url'     => 'paypal/notify',
    'locale'         => 'pl_PL',
    'validate_ssl'   => true,
];
