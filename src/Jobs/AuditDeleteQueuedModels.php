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

namespace Iconscout\Auditing\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Iconscout\Auditing\Drivers\ElasticSearch;

class AuditDeleteQueuedModels implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $model;

    /**
     * Create a new job instance.
     *
     * @param mixed $model
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Audit the model auditable.
     *
     * @param \OwenIt\Auditing\AuditorManager $manager
     *
     * @return void
     */
    public function handle(ElasticSearch $elasticsearch)
    {
        $elasticsearch->deleteAuditDocument($this->model);
    }
}
