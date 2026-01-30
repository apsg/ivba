<?php

return [
    'pk'                   => env('STRIPE_PUBLIC'),
    'sk'                   => env('STRIPE_SECRET'),
    'subscription_product' => env('STRIPE_SUBSCRIPTION_PRODUCT_ID'),
    'automatic'            => [
        'full_access'  => [
            'prod_MooRtPaHwZoSub', // test
        ],
        'subscription' => [
            'prod_MjardqCx01poGx', // Production IS
            'prod_MooSFl3WjyXRuU', // test IS
            'prod_MwytfH8LrIVPK0', // Prod iNauka
            'prod_MyXueF7WD386Kn', // Test iNauka
            'prod_Tt7r5Uqrwk4JFl', // techniczni
        ],
    ],
];
