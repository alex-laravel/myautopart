<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;

class TecDocVehiclesCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:vehicles {manufacturerId} {modelId}';

    /**
     * @var string
     */
    protected $description = 'Sync TecDoc Vehicles';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $manufacturerId = (int)$this->argument('manufacturerId');
        $modelId = (int)$this->argument('modelId');

        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getVehicleIdsByCriteria' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
                'countriesCarSelection' => config('tecdoc.api.country'),
                'carType' => self::TEC_DOC_TARGET_TYPE_PASSENGER . self::TEC_DOC_TARGET_TYPE_COMMERCIAL . self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT,
                'manuId' => $manufacturerId,
                'modId' => $modelId,
                'favouredList' => null
            ]
        ]);

        $this->line($response->body());
    }
}
