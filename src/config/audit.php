<?php

/**
 * This file is part of the Laravel Auditing package.
 *
 * @author     Arpan Rank <arpan@iconscout.com>
 * @copyright  2018
 *
 * For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Audit Implementation
    |--------------------------------------------------------------------------
    |
    | Define which Audit model implementation should be used.
    |
    */

    'implementation' => OwenIt\Auditing\Models\Audit::class,

    /*
    |--------------------------------------------------------------------------
    | User Keys, Model
    |--------------------------------------------------------------------------
    |
    | Define the User primary key, foreign key and Eloquent model.
    |
    */

    'user' => [
        'primary_key' => 'id',
        'foreign_key' => 'user_id',
        'model'       => App\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Resolvers
    |--------------------------------------------------------------------------
    |
    | Define the User, IP Address, User Agent and URL resolver implementations.
    |
    */
    'resolver' => [
        'user'       => OwenIt\Auditing\Resolvers\UserResolver::class,
        'ip_address' => OwenIt\Auditing\Resolvers\IpAddressResolver::class,
        'user_agent' => OwenIt\Auditing\Resolvers\UserAgentResolver::class,
        'url'        => OwenIt\Auditing\Resolvers\UrlResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Events
    |--------------------------------------------------------------------------
    |
    | The Eloquent events that trigger an Audit.
    |
    */

    'events' => [
        'created',
        'updated',
        'deleted',
        'restored',
    ],

    /*
    |--------------------------------------------------------------------------
    | Strict Mode
    |--------------------------------------------------------------------------
    |
    | Enable the strict mode when auditing?
    |
    */

    'strict' => env('AUDIT_STRICT', false),

    /*
    |--------------------------------------------------------------------------
    | Audit Timestamps
    |--------------------------------------------------------------------------
    |
    | Should the created_at, updated_at and deleted_at timestamps be audited?
    |
    */

    'timestamps' => env('AUDIT_TIMESTAMPS', true),

    /*
    |--------------------------------------------------------------------------
    | Audit Threshold
    |--------------------------------------------------------------------------
    |
    | Specify a threshold for the amount of Audit records a model can have.
    | Zero means no limit.
    |
    */

    'threshold' => env('AUDIT_THRESHOLD', 0),

    /*
    |--------------------------------------------------------------------------
    | Queue Auditable Models
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that audit your models
    | with your auditors are queued. When this is set to "true" then all models 
    | auditable will get queued for better performance.
    |
    */

    'queue' => env('AUDIT_QUEUE', true),

    /*
    |--------------------------------------------------------------------------
    | Audit Driver
    |--------------------------------------------------------------------------
    |
    | The default audit driver used to keep track of changes.
    |
    */

    'driver' => Iconscout\Auditing\Drivers\ElasticSearch::class,

    /*
    |--------------------------------------------------------------------------
    | Audit Driver Configurations
    |--------------------------------------------------------------------------
    |
    | Available audit drivers and respective configurations.
    |
    */

    'drivers' => [
        'database' => [
            'table'      => 'audits',
            'connection' => null,
        ],
        'es' => [
            'client' => [
                'hosts' => [
                    env('AUDIT_HOST', 'localhost:9200')
                ]
            ],
            'index' => env('AUDIT_INDEX', 'laravel_auditing'),
            'type' => env('AUDIT_TYPE', 'audits')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Console
    |--------------------------------------------------------------------------
    |
    | Whether console events should be audited (eg. php artisan db:seed).
    |
    */

    'console' => false,
];
