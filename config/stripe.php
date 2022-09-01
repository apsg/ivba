<?php

return [
    'pk'                   => env('STRIPE_PUBLIC'),
    'sk'                   => env('STRIPE_SECRET'),
    'subscription_product' => env('STRIPE_SUBSCRIPTION_PRODUCT_ID'),
];
