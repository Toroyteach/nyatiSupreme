<?php

return [

/*
|--------------------------------------------------------------------------
| Default Account
|--------------------------------------------------------------------------
|
| This is the default account to be used when none is specified.
*/

'default' => 'staging',

/*
|--------------------------------------------------------------------------
| File Cache Location
|--------------------------------------------------------------------------
|
| When using the Native Cache driver, this will be the relative directory
| where the cache information will be stored.
*/

'cache_location' => '../cache',

/*
|--------------------------------------------------------------------------
| Accounts
|--------------------------------------------------------------------------
|
| These are the accounts that can be used with the package. You can configure
| as many as needed. Two have been setup for you.
|
| Sandbox: Determines whether to use the sandbox, Possible values: sandbox | production
| Initiator: This is the username used to authenticate the transaction request
| LNMO:
|    shortcode: The till number
|    passkey: The passkey for the till number
|    callback: Endpoint that will be be queried on completion or failure of the transaction.
|
*/

    'accounts' => [
        'staging' => [
            'sandbox' => true,
            'key' => env('MPESA_CONSUMER_KEY'),
            'secret' => env('MPESA_CONSUMER_SECRET'),
            'initiator' => 'Nyati Supreme Concrete Works',
            'id_validation_callback' => '',
            'lnmo' => [
                'paybill' => '174379',
                'shortcode' => '174379',
                'passkey' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
                'callback' => env('MPESA_CALLBACK_URL'),
            ]
        ],

        'paybill_1' => [
            'sandbox' => false,
            'key' => 'your production consumer key',
            'secret' => 'your production consumer secret',
            'initiator' => 'your production username',
            'id_validation_callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            'lnmo' => [
                'paybill' => 'your production paybill number',
                'shortcode' => 'your production business code',
                'passkey' => 'your production passkey',
                'callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            ]
        ],

        'paybill_2' => [
            'sandbox' => false,
            'key' => 'your production consumer key',
            'secret' => 'your production consumer secret',
            'initiator' => 'your production username',
            'id_validation_callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            'lnmo' => [
                'paybill' => 'your production paybill number',
                'shortcode' => 'your production business code',
                'passkey' => 'your production passkey',
                'callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            ]
        ],
    ],
];