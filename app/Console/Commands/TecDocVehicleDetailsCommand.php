<?php

namespace App\Console\Commands;

use App\Models\TecDoc\Vehicle;
use App\Models\TecDoc\VehicleDetails;
use Illuminate\Support\Facades\Http;

class TecDocVehicleDetailsCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:vehicle-details';

    /**
     * @var string
     */
    protected $description = 'Generate TecDoc Vehicle Details';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', 0);

        $vehicleIds = Vehicle::orderBy('carId')->get()->pluck('carId')->toArray();

        foreach (array_chunk($vehicleIds, 20) as $vehicleIdsChunk) {
            $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
                'getVehicleByIds4' => [
                    'articleCountry' => config('tecdoc.api.country'),
                    'country' => config('tecdoc.api.country'),
                    'countriesCarSelection' => config('tecdoc.api.country'),
                    'carIds' => [
                        'array' => $vehicleIdsChunk
                    ],
                    'lang' => config('tecdoc.api.language'),
                    'provider' => config('tecdoc.api.provider'),
                ]
            ]);

            $response = $response->json();

            if (!$this->hasSuccessResponse($response)) {
                $this->warn($response['status'] . ' - ' . $response['statusText']);
                continue;
            }

            $response = $this->getResponseDataAsArray($response);

            if (empty($response)) {
                $this->warn('Empty response!');
                continue;
            }

            $summary = [];

            foreach ($response as &$details) {
                if (!isset($details['vehicleDetails'])) {
                    $this->warn('Empty [vehicleDetails] in response!');
                    continue;
                }

                $details['vehicleDetails']['vehicleDocId'] = array_key_exists('vehicleDocId', $details) ? $details['vehicleDocId'] : null;
                VehicleDetails::create($details['vehicleDetails']);
            }

            $this->info('Done for Car ID [' . implode(", ", $vehicleIdsChunk) . ']!');
        }

        $this->info('Completed!');
    }
}
