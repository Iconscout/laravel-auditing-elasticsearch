This driver provides the ability to save your model audits in elasticsearch.

### Installation

This driver requires that you are using `owen-it/laravel-auditing: ^6.0`. Provided this is fulfilled,
you can install the driver like so:

```
composer require iconscout/laravel-auditing-elasticsearch
```

### Setup

You need to add the following config entries in config/audit.php if you need to change the default behaviour of the driver.
The `queue` key of the config file should look like so:

```
    ...
    'queue' => env('AUDIT_QUEUE', true),
    ...
```

OR

```
    ...
    'queue' => env('AUDIT_QUEUE', [
        'queue' => 'default',
        'connection' => 'redis'
    ]),
    ...
```

The `driver` key of the config file should look like so:

```
    ...
    'driver' => Iconscout\Auditing\Drivers\ElasticSearch::class,
    ...
```

The `drivers` key of the config file should look like so:

```
    ...
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
        ],
    ],
    ...
```

### Usage

You can use the driver in any Auditable model like so:

```
<?php
namespace App\Models;

use Iconscout\Auditing\Drivers\ElasticSearch;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SomeModel extends Model implements AuditableContract
{
    use Auditable;

    /**
     * ElasticSearch Audit Driver
     *
     * @var Iconscout\Auditing\Drivers\ElasticSearch
     */
    protected $auditDriver = ElasticSearch::class;

    // ...
}
```

More information on using customer drivers with owen-it/laravel-auditing can be found on their [homepage](http://laravel-auditing.com/docs/6.0/audit-drivers)