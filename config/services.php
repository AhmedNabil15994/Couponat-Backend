<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    "sms"=>[
        "default" => env("SMS_DEFAULT", "sms_box"),
        "test"    => env("SMS_TEST", false),
        "sms_box"=>[
            "username" => env("SMS_BOX_USERNAME", "test"),
            "password" => env("SMS_BOX_PASSWORD", "password") ,
            "customerId"=> env("SMS_BOX_CUSTOMER_ID", "3357") ,
            "senderText"=> env("SMS_BOX_SENDER_TEXT", "KW-INFO"),
            "defdate"   => env("SMS_BOX_DEF_DATE", ""),
            "isBlink"  => env("SMS_BOX_IS_BLINK", false),
            "isFlash"  => env("SMS_BOX_IS_FLASH", false),
        ]
    ],
];
