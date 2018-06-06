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

namespace Iconscout\Auditing;

use Illuminate\Support\ServiceProvider;

use Iconscout\Auditing\Console\IndexCommand;
use Iconscout\Auditing\Console\DeleteCommand;

class ElasticSearchAuditingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                IndexCommand::class,
                DeleteCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/config/audit.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'audit.php',
            ]);
        }
    }
}
