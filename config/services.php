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
    'google' => [
        'client_id' => '723897800511-kb0qusa24epj83efj56ltho8c7lal8sj.apps.googleusercontent.com',
        'client_secret' => 'l0KKhi2DN5mw7QNQrrM7zIqT',
        'redirect' => env('APP_ENV') == 'local' ? 'http://localhost:8000/auth/google' : 'https://ikamansatumedan.com/auth/google',
    ],
    'facebook' => [
        'client_id' => '355939492715893',
        'client_secret' => 'cf6b509bde1a120dd1a0c6196df3c603',
        'redirect' => env('APP_ENV') == 'local' ? 'http://localhost:8000/auth/facebook' : 'https://ikamansatumedan.com/auth/facebook',
    ],
];
