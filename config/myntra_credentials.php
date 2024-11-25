<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Oayment Gateway services such
    | as CashFree, PayU & Status (Redundant Component). This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'status' => [
        'Active' =>'1',
        'Inactive' =>'0'
    ],
    'payU_credentials' => [
        'PAYU_URL' => env('PAYU_URL'),
        'PAYU_BASE_URL' => env('PAYU_BASE_URL'),
        'PAYU_MERCHANT_KEY' => env('PAYU_MERCHANT_KEY'),
        'PAYU_MERCHANT_SALT' => env('PAYU_MERCHANT_SALT'),
    ],
    'cashfree_credentials' => [
        'CF_APP_ID' => env('CASHFREE_APP_ID'),
        'CF_SECRET_KEY' => env('CASHFREE_SECRET_KEY'),
        'CF_ENV' => env('CASHFREE_ENV'),
        'CF_PAYMENT_URL' => env('CASHFREE_PAYMENT_URL'),
        'CF_URL' => env('CASHFREE_URL'),
    ],
    'smtp_credentials' => [
        "MAIL_MAILER" => env('MAIL_MAILER'),
        "MAIL_HOST" => env('MAIL_HOST'),
        "MAIL_PORT" => env('MAIL_PORT'),
        "MAIL_USERNAME" => env('MAIL_USERNAME'),
        "MAIL_PASSWORD" => env('MAIL_PASSWORD'),
        "MAIL_ENCRYPTION" => env('MAIL_ENCRYPTION'),
    ],
    'user_credentials' => [
        'ADMIN_EMAIL' => env('ADMIN_EMAIL'),
    ],
];