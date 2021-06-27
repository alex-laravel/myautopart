<?php

namespace App\Http\Controllers\TecDoc;

use App\Models\TecDoc\CountryGroup;
use Illuminate\Support\Facades\Http;


class TecDocApiCountryGroupsController extends TecDocApiController
{
    public function __invoke()
    {
        $response = Http::withHeaders(['X-Api-Key' => self::TEC_DOC_API_KEY])->post(self::TEC_DOC_API_ENDPOINT, [
            'getCountryGroups' => [
                'provider' => self::TEC_DOC_API_PROVIDER,
                'lang' => config('tecdoc.language'),
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

//        CountryGroup::insert($response);
    }
}
