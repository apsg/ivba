<?php

return [
    'pk'                   => env('STRIPE_PUBLIC'),
    'sk'                   => env('STRIPE_SECRET'),
    'subscription_product' => env('STRIPE_SUBSCRIPTION_PRODUCT_ID'),
    'automatic'            => [
        'full_access'  => [
            'prod_MjardqCx01poGx', // Production
            'prod_MooRtPaHwZoSub', // test
        ],
        'subscription' => [
            'prod_MnZebeQOIyJObC', // Production
            'prod_MooSFl3WjyXRuU', // test
        ],
    ],
];
