<?php

return [
    //Merchant
    'merchant_host'       => env('PAYEER_MERCHANT_HOST', '127.0.0.1'),
    'merchant_shop'       => env('PAYEER_MERCHANT_SHOP', ''),
    'merchant_secret_key' => env('PAYEER_MERCHANT_SECRET_KEY', ''),
    'merchant_allow_ips'  => explode(',', env('PAYEER_MERCHANT_ALLOW_IPS', '127.0.0.1')),

    //API
    'account'             => env('PAYEER_ACCOUNT', ''),
    'api_id'              => env('PAYEER_API_ID', ''),
    'api_pass'            => env('PAYEER_API_PASS', ''),
];
