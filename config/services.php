<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'fakturownia' => [
        'url'   => env('FAKTUROWNIA_URL', 'https://tmgfv.fakturownia.pl'),
        'token' => env('FAKTUROWNIA_TOKEN', '4LKI41aAgCU8lzjdiVB7/tmgfv'),
    ],

    'getresponse' => [
        'key' => env('GETRESPONSE_KEY'),
    ],

    'mailerlite' => [
        'key' => env('MAILERLITE_KEY'),
    ],

    'freshdesk' => [
        'email'  => env('FRESHDESK_SUPPORT_MAIL', 'support@tmg.freshdesk.com'),
    ],
];
