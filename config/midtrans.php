<?php

return [
    'client-key' => env('MIDTRANS_CLIENT_KEY'),
    'server-key' => env('MIDTRANS_SERVER_KEY'),
    'is-production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is-sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];
