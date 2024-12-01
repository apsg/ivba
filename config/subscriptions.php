<?php

use App\Payments\PaymentService;

return [
    'provider' => env('SUBSCRIPTIONS_PROVIDER', PaymentService::DRIVER_NONE),
];
