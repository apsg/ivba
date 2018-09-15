<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME',
            'szymon.gackowski-facilitator_api1.gmail.com'
        ),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'Y4R3W32MPWTJD6LE'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A3pQTWE2xOfCqmLmfDdLmTnCVrcx'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'Aep4-5KAo3q7e-F947U7VZL6Gef9zMTDCQjZsSbc23K0yLlpMu37K49qCafG-SZZhCjBEHKjWnUJvU4o',
        // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live'    => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', 'kontakt@hrvshop.com'),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', 'hrvdupa498'),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'PLN',
    'notify_url'     => 'paypal/notify', // Change this accordingly for your application.
    'locale'         => 'pl_PL', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
