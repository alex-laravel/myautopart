<?php

namespace App\Console\Commands;

use App\Jobs\TecDoc\DirectArticleJob;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use App\Models\TecDoc\Vehicle\Vehicle;
use Illuminate\Console\Command;

class TecDocDirectArticlesQueueCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:direct-articles-queue';

    /**
     *
     * @var string
     */
    protected $description = 'Create TecDoc Direct Articles Queues';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @return void
     */
    public function handle()
    {
        ini_set('max_execution_time', 0);

        DirectArticle::truncate();

        $vehicleIds = Vehicle::orderBy('carId')->get()->pluck('id')->toArray();

        foreach (array_chunk($vehicleIds, 100) as $vehicleIdsChunk) {
            foreach ($vehicleIdsChunk as $vehicleId) {
                DirectArticleJob::dispatch($vehicleId);

                \Log::debug('PUSHED JOB FOR VEHICLE ID [' . $vehicleId . '].');
            }

            unset($vehicleIdsChunk);
        }

        unset($vehicleIds);
    }
}
