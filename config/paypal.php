<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'm.grabowski-facilitator@itbt.pl'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'MML3W5W9R6R3DBXT'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'EJQ2joMpuFsPL7sknDNHjaZK5SfLktHrFg_qAsmsfxchruioP0n16D7GE7-1zDFK1vdTfYGiIebaWcCH'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'ARDPkU14lW8iirHNtpZ4kuRwtGrlzjX6_xCkDOpkwibOLcDPfbl7tGGkokmL7JItMExctVEZCpoyv6kM',
        // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live'    => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', 'm.grabowski@itbt.pl'),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', 'hrvdupa498'),
        'secret'      => env('PAYPAL_LIVE_API_SECRET',
            'EJtj0MqwAFhQ5Kr668Wm5JJ7-QJGZGo9j3KmPDPtYrmDWHd8C-oJTNbRzLLQfW82FfM09e3A_bZUlLUN'),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => 'AbKs5x4oqo28dLYBAqiP0j6TMdDBlOg1qRqM-KywP1x0qU88yYOGP9bdEwQaaIT2OqQV5d-vHnFChwUH',
        // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'PLN',
    'notify_url'     => 'paypal/notify', // Change this accordingly for your application.
    'locale'         => 'pl_PL', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
