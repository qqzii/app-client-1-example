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
        'token' => env('POSTMARK_TOKEN'),
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

    'skolkovo' => [
        'client_id' => env('SKOLKOVO_CLIENT_ID'),
        'client_secret' => env('SKOLKOVO_CLIENT_SECRET'),
        'redirect' => '/socialite/skolkovo/callback',
        'authorize_url' => env('SKOLKOVO_AUTHORIZE_URL'),
        'token_url' => env('SKOLKOVO_TOKEN_URL'),
        'api_url' => env('SKOLKOVO_API_URL'),
        'url' => env('SKOLKOVO_URL'),
    ],
];
