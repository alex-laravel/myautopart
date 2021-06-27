<?php


namespace App\Http\Controllers\TecDoc;


use App\Models\TecDoc\Manufacturer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TecDocApiManufacturersController extends TecDocApiController
{
    public function __invoke()
    {
        $response = Http::withHeaders(['X-Api-Key' => self::TEC_DOC_API_KEY])->post(self::TEC_DOC_API_ENDPOINT, [
            'getManufacturers' => [
                'provider' => self::TEC_DOC_API_PROVIDER,
                'lang' => config('tecdoc.language'),
                'country' => config('tecdoc.country'),
                'linkingTargetType' => self::TEC_DOC_TARGET_TYPE_PASSENGER,
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

        foreach ($response as &$manufacturer) {
            $manufacturer['slug'] = Str::slug($manufacturer['manuName']);
            $manufacturer['isVisible'] = false;
            $manufacturer['isPopular'] = false;
        }

//        Manufacturer::insert($response);
    }
}
