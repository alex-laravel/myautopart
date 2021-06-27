<?php


namespace App\Http\Controllers\TecDoc;


use App\Models\TecDoc\VehicleDetails;
use Illuminate\Support\Facades\Http;

class TecDocApiVehicleDetailsController extends TecDocApiController
{
    public function __invoke()
    {
        $response = Http::withHeaders(['X-Api-Key' => self::TEC_DOC_API_KEY])->post(self::TEC_DOC_API_ENDPOINT, [
            'getVehicleByIds3' => [
                'articleCountry' => config('tecdoc.country'),
                'country' => config('tecdoc.country'),
                'countriesCarSelection' => config('tecdoc.country'),
                'carIds' => [
                    'array' => [
                        18692,
                        27316,
                        16624
                    ]
                ],
                'lang' => config('tecdoc.language'),
                'provider' => self::TEC_DOC_API_PROVIDER,
            ]
        ]);

        var_dump($response->body());

        $response = $response->json();

        if (!$this->hasSuccessResponse($response)) {
            return false;
        }

        $response = $this->getResponseDataAsArray($response);

        if (empty($response)) {
            return false;
        }

//        VehicleDetails::insert($response);
    }
}
