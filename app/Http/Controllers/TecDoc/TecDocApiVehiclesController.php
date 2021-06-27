<?php


namespace App\Http\Controllers\TecDoc;


use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle;
use Illuminate\Support\Facades\Http;

class TecDocApiVehiclesController extends TecDocApiController
{
    public function __invoke()
    {
        foreach (ModelSeries::get() as $modelSeries) {
            if ($modelSeries->id >= 6000 && $modelSeries->id <= 6300) {
                var_dump('PARSE VEHICLE MANU ID [' . $modelSeries->manuId . ']');

                $response = Http::withHeaders(['X-Api-Key' => self::TEC_DOC_API_KEY])->post(self::TEC_DOC_API_ENDPOINT, [
                    'getVehicleIdsByCriteria' => [
                        'provider' => self::TEC_DOC_API_PROVIDER,
                        'countriesCarSelection' => config('tecdoc.country'),
                        'lang' => config('tecdoc.language'),
                        'carType' => self::TEC_DOC_TARGET_TYPE_PASSENGER,
                        'manuId' => $modelSeries->manuId,
                        'modId' => $modelSeries->modelId,
                    ]
                ]);

//        var_dump($response->body());

                $response = $response->json();

                if (!$this->hasSuccessResponse($response)) {
                    return false;
                }

                $response = $this->getResponseDataAsArray($response);

                if (empty($response)) {
                    return false;
                }

                foreach ($response as &$vehicle) {
                    $vehicle['manuId'] = $modelSeries->manuId;
                    $vehicle['modelId'] = $modelSeries->modelId;
                }

//        Vehicle::insert($response);

            }
        }
    }
}
