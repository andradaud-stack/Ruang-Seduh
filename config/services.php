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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', '/auth/google/callback'),
    ],

    'webpush' => [
        'public_key'  => env('VAPID_PUBLIC_KEY', 'BK872yQ1H21cCLL_QGvMKLprLXLUQNY_7-iUixUgE_olDfJmXjaN_t1guKbEFQ9Far5N-R2mU3VhxKWI9fbS6w4'),
        'private_key' => env('VAPID_PRIVATE_KEY', 'LAQiB3PCLxdU9Cobe6TFHV8WUJgZGIsmUnkqWoitFcY'),
        'subject'     => env('VAPID_SUBJECT', 'mailto:admin@ruangseduh.com'),
    ],

];
