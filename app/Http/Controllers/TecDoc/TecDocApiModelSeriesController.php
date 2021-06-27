<?php


namespace App\Http\Controllers\TecDoc;


use App\Models\TecDoc\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use Illuminate\Support\Facades\Http;

class TecDocApiModelSeriesController extends TecDocApiController
{
    public function __invoke()
    {
        foreach (Manufacturer::get() as $manufacture) {

            if ($manufacture->id >= 211 && $manufacture->id <= 310) {
                var_dump('PARSE MANU ID [' . $manufacture->manuId . ']');
                var_dump("\n");

                $response = Http::withHeaders(['X-Api-Key' => self::TEC_DOC_API_KEY])->post(self::TEC_DOC_API_ENDPOINT, [
                    'getModelSeries' => [
                        'provider' => self::TEC_DOC_API_PROVIDER,
                        'lang' => config('tecdoc.language'),
                        'country' => config('tecdoc.country'),
                        'linkingTargetType' => self::TEC_DOC_TARGET_TYPE_PASSENGER,
                        'manuId' => $manufacture->manuId,
                    ]
                ]);

//                var_dump($response->body());

                $response = $response->json();

                if (!$this->hasSuccessResponse($response)) {
                    return false;
                }

                $response = $this->getResponseDataAsArray($response);

                if (empty($response)) {
                    return false;
                }

                foreach ($response as &$model) {
                    $model['manuId'] = $manufacture->manuId;

                    if (!array_key_exists('yearOfConstrFrom', $model)) {
                        $model['yearOfConstrFrom'] = null;
                    }

                    if (!array_key_exists('yearOfConstrTo', $model)) {
                        $model['yearOfConstrTo'] = null;
                    }
                }

//                ModelSeries::insert($response);
            }
        }
    }
}
