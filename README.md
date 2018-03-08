# Auditing Elasticsearch Driver

[![Latest Unstable Version](https://poser.pugx.org/iconscout/laravel-auditing-elasticsearch/v/unstable)](https://packagist.org/packages/iconscout/laravel-auditing-elasticsearch) [![Total Downloads](https://poser.pugx.org/iconscout/laravel-auditing-elasticsearch/downloads)](https://packagist.org/packages/iconscout/laravel-auditing-elasticsearch) [![License](https://poser.pugx.org/iconscout/laravel-auditing-elasticsearch/license)](https://packagist.org/packages/iconscout/laravel-auditing-elasticsearch)

This driver provides the ability to save your model audits in elasticsearch.

## Contents

* [Installation](#installation)
* [Setup](#setup)
* [Console commands](#console-commands)
* [Usage](#usage)
* [Donate](#donate)

## Installation

This driver requires that you are using `owen-it/laravel-auditing: ^6.0`. Provided this is fulfilled,
you can install the driver like so:

```
composer require iconscout/laravel-auditing-elasticsearch
```

## Setup

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

## Console commands

Available artisan commands are listed below:

Command | Arguments | Description
--- | ---
auditing:es-index | Index all of the model's records into the search index.
auditing:es-delete | Delete all of the model's records from the index.

For detailed description and all available options run `php artisan help [command]` in the command line.

## Usage

You can use the ElasticSearch driver in any Auditable model like so in order to store audit records in elasticsearch:

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

You can use the ElasticSearchAuditable trait in any Auditable model like so in order to retrieving Retrieving audit records records from elasticsearch:

```
<?php
namespace App\Models;

use Iconscout\Auditing\Drivers\ElasticSearch;
use Iconscout\Auditing\Traits\ElasticSearchAuditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SomeModel extends Model implements AuditableContract
{
    use Auditable, ElasticSearchAuditable;

    /**
     * ElasticSearch Audit Driver
     *
     * @var Iconscout\Auditing\Drivers\ElasticSearch
     */
    protected $auditDriver = ElasticSearch::class;

    // ...
}
```

```
// Get first available Icon
$icon = Icon::first();

// Get all associated Audits
$all = $icon->esAudits;

// Get all associated Audits via parameters ($page & $perPage)
$all = $icon->esAudits($page = 1, $perPage = 10);
```

## Donate

:coffee: If you like my package, it'd be nice of you [to buy me a cup of coffee](https://www.paypal.me/rankarpan).

More information on using customer drivers with owen-it/laravel-auditing can be found on their [homepage](http://laravel-auditing.com/docs/6.0/audit-drivers)