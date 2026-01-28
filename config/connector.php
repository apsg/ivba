<?php

return [
    'key' => env('CONNECTOR_KEY'),

    'certificates' => [
        'url' => env('CERTIFICATES_URL', 'https://certyfikat.inauka.pl'),
        'key' => env('CERTIFICATES_KEY'),
    ],

    'providers' => [
        'inauka'     => 'https://inauka.pl',
        'inauka_key' => env('INAUKA_CONNECTOR_KEY'),
    ],
];
