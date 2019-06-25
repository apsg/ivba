<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id'     => '033cdd951f48648e3b34ae8bbc3ee97368a608b4',
            'client_secret' => 'oMFsqZQlYJpRB3zSXF1mxVqrk+DeeHPraYkvVbjQYkd38bsyoZ8p1M4w0UorG5++/nTeGjLPFqcqUVSwQfwvvrQ5SNCAF6kMjNOFWa+N8WZncTRinLprFBbxuHil78u3',
            'access_token'  => 'a04287cd51a2eaa005d2f8f9d8d2de6e',
        ],

        'alternative' => [
            'client_id'     => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'access_token'  => null,
        ],

    ],

];
