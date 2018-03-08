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

namespace Iconscout\Auditing\Console;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Config;
use Iconscout\Auditing\Drivers\ElasticSearch;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:es-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete all of the model's records from the index";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ElasticSearch $elasticsearch)
    {
        $index = Config::get('audit.drivers.es.index', 'laravel_auditing');

        if ($elasticsearch->existsIndex()) {

            $elasticsearch->deleteIndex();
            $this->info("The {$index} index was deleted!");

        } else {
            $this->info("The {$index} index doesn't exist!");
        }
    }
}
