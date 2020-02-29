<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Social Network Configuration
    |--------------------------------------------------------------------------
    |
    |
    */

    'twitter' => [
        'oauth2' => env('TWITTER_BEARER_TOKEN', ''),
        'consumer_key'  => env('TWITTER_CONSUMER_KEY', ''),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET', ''),
        'token'       => env('TWITTER_TOKEN', ''),
        'token_secret'  => env('TWITTER_TOKEN_SECRET', '')
    ],

];
