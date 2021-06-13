<?php
return [
    'env' => env('MPESA_ENVIRONMENT', 'sandbox'),
    'c2b' => [
        'sandbox' => [
            'short_code' => env("MPESA_SANDOX_SHORT_CODE"),
            'validation_key' => env("MPESA_SANDOX_VALIDATION_KEY"),
            'confirmation_key' => env("MPESA_SANDBOX_CONFIRMATION_KEY"),
            'consumer_secret' => env("MPESA_CONSUMER_SECRET"),
            'consumer_key' => env("MPESA_CONSUMER_KEY"),
        ],
        'live' => [
            'short_code' => env("MPESA_LIVE_SHORT_CODE"),
            'validation_key' => env("MPESA_LIVE_VALIDATION_KEY"),
            'confirmation_key' => env("MPESA_LIVE_CONFIRMATION_KEY"),
            'consumer_secret' => env("MPESA_CONSUMER_SECRET"),
            'consumer_key' => env("MPESA_CONSUMER_KEY"),
        ],
    ],
    'stk_push' => [
        'sandbox' => [
            'pass_key' => env("MPESA_SANDBOX_PASSKEY"),
            'confirmation_key' => env("MPESA_STK_CONFIRMATION_KEY"),
            'short_code' => env("MPESA_SHORT_CODE"),
        ],
        'live' => [
            'pass_key' => env("MPESA_LIVE_PASSKEY"),
            'confirmation_key' => env("MPESA_STK_CONFIRMATION_KEY"),
            'short_code' => env("MPESA_SHORT_CODE"),
        ]
    ],

];