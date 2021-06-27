<?php

namespace App\Http\Controllers\TecDoc;

use Illuminate\Support\Facades\Http;


class TecDocApiVersionController extends TecDocApiController
{
    public function __invoke()
    {
//        $response = Http::post(self::TEC_DOC_API_ENDPOINT, [
//            'getPegasusVersionInfo' => [
//                'provider' => self::TEC_DOC_API_PROVIDER
//            ]
//        ]);

//        $response = Http::post(config('tecdoc.api.url'), [
//            'getAPIKeyForUser' => [
//                'catalog' => 'tecdocsw',
//                'username' => '208986u1',
//                'password' => '#Lb8zjwF',
//            ]
//        ]);

        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getAmBrandAddress' => [
                'articleCountry' => config('tecdoc.api.country'),
                'lang' => config('tecdoc.api.language'),
                'brandNo' => 33,
                'provider' => config('tecdoc.api.provider')
            ]
        ]);

        var_dump('<pre>');
        var_dump($response->json());
        var_dump('</pre>');
        exit;
    }
}
