<?php

return [
    'ssl' => [
        'endpoint'         => env('SSL_ENDPOINT'),
        'store_id'         => env('SSL_STORE_ID'),
        'store_password'   => env('SSL_STORE_PASSWORD'),
        'callback_success' => env('SSL_CALLBACK_SUCCESS'),
        'callback_fail'    => env('SSL_CALLBACK_FAIL'),
        'callback_cancel'  => env('SSL_CALLBACK_CANCEL'),
        'callback_ipn'     => env('SSL_CALLBACK_IPN')
    ],

    "bkash" => [
        "endpoint"   => env("BKASH_ENDPOINT"),
        "username"   => env("BKASH_USERNAME"),
        "password"   => env("BKASH_PASSWORD"),
        "app_key"    => env("BKASH_APP_KEY"),
        "app_secret" => env("BKASH_APP_SECRET")
    ]
];