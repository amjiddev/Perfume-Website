<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PakPay Environment
    |--------------------------------------------------------------------------
    |
    | Set the environment for PakPay integration
    | Options: 'sandbox' or 'production'
    |
    */
    'environment' => env('PAKPAY_ENVIRONMENT', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | JazzCash Configuration
    |--------------------------------------------------------------------------
    */
    'jazzcash' => [
        'merchant_id' => env('JAZZCASH_MERCHANT_ID'),
        'password' => env('JAZZCASH_PASSWORD'),
        'integrity_salt' => env('JAZZCASH_INTEGRITY_SALT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | EasyPaisa Configuration
    |--------------------------------------------------------------------------
    */
    'easypaisa' => [
        'store_id' => env('EASYPAISA_STORE_ID'),
        'username' => env('EASYPAISA_USERNAME'),
        'password' => env('EASYPAISA_PASSWORD'),
        'private_key' => env('EASYPAISA_PRIVATE_KEY'),
        'method' => env('EASYPAISA_METHOD', 'rest'), // 'rest' or 'legacy'
    ],

    /*
    |--------------------------------------------------------------------------
    | SafePay Configuration (Optional)
    |--------------------------------------------------------------------------
    */
    'safepay' => [
        'secret_key' => env('SAFEPAY_SECRET_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | NayaPay Configuration (Optional)
    |--------------------------------------------------------------------------
    */
    'nayapay' => [
        'secret_key' => env('NAYAPAY_SECRET_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | PayFast Configuration (Optional)
    |--------------------------------------------------------------------------
    */
    'payfast' => [
        'secret_key' => env('PAYFAST_SECRET_KEY'),
    ],
];
