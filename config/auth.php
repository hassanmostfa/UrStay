<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | A default configuration is provided which uses session storage and
    | the Eloquent user provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
            'hash' => false,
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'adminApi' => [
            'driver' => 'sanctum',
            'provider' => 'admins',
            'hash' => false,
        ],
        'supervisor' => [
            'driver' => 'session',
            'provider' => 'supervisors',
        ],
        'owner' => [
            'driver' => 'session',
            'provider' => 'owners',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | This option defines how users are retrieved from your database or other
    | storage mechanisms used by this application to persist your user's data.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'owners' => [
            'driver' => 'eloquent',
            'model' => App\Models\Owner::class,
        ],

        'supervisors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Supervisor::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model and want separate reset settings for each.
    |
    | The expire time is the number of minutes each reset token is valid.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'owners' => [
            'provider' => 'owners',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'supervisors' => [
            'provider' => 'supervisors',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | This is the amount of seconds before a password confirmation times out
    | and prompts the user to re-enter their password. By default, the timeout
    | lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
