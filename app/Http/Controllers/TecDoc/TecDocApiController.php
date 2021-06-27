<?php

namespace App\Http\Controllers\TecDoc;

use App\Http\Controllers\Controller;


class TecDocApiController extends Controller
{
    const TEC_DOC_API_ENDPOINT = 'http://webservice.tecalliance.services/pegasus-3-0/services/TecdocToCatDLB.jsonEndpoint';
    const TEC_DOC_API_KEY = '2BeBXg69osbuG45Rjtv1wLEnHL3nuT3VoeHmGzDmGfZoVg5fxBHq';
    const TEC_DOC_API_PROVIDER = 40000;

    const TEC_DOC_TARGET_TYPE_PASSENGER = 'P';
    const TEC_DOC_TARGET_TYPE_COMMERCIAL = 'O';
    const TEC_DOC_TARGET_TYPE_AXLES = 'A';
    const TEC_DOC_TARGET_TYPE_MOTOR = 'M';

    /**
     * @param array $response
     * @return bool
     */
    protected function hasSuccessResponse($response)
    {
        return $this->hasSuccessStatus($response) && $this->hasData($response);
    }

    /**
     * @param array $response
     * @return bool
     */
    protected function hasSuccessStatus($response)
    {
        return is_array($response) && array_key_exists('status', $response) && $response['status'] === 200;
    }

    /**
     * @param array $response
     * @return bool
     */
    protected function hasData($response)
    {
        return is_array($response) && array_key_exists('data', $response);
    }

    /**
     * @param array $response
     * @return array
     */
    protected function getResponseDataAsArray($response)
    {
        return is_array($response['data']) && array_key_exists('array', $response['data']) ? $response['data']['array'] : [];
    }

    //$response = Http::get(self::TEC_DOC_API_ENDPOINT);
    //$response = Http::post(self::TEC_DOC_API_ENDPOINT, []);

    //$response->body();
    //$response->json();
    //$response->collect();
    //$response->status();
    //$response->ok();
    //$response->successful();
    //$response->failed();
    //$response->serverError();
    //$response->clientError();
    //$response->header($header);
    //$response->headers();

    //var_dump('STATUS', $response->status());
    //var_dump('OK: ', $response->ok());
    //var_dump('SUCCESSFUL', $response->successful());
    //var_dump('FAILED', $response->failed());
    //var_dump('SERVER ERROR', $response->serverError());
    //var_dump('CLIENT ERROR', $response->clientError());
    //var_dump('BODY', $response->body());
    //var_dump('JSON', $response->json());
    //var_dump('COLLECTION', $response->collect());
    //var_dump('HEADERS', $response->headers());
    //var_dump($response->header($header) : string;

//    private function parseBrands()
//    {
//        $data = [
//            'https://assets.tecalliance.net/manufacturers/passenger/3854.png' => 'ABARTH',
//        ];
//
//        foreach ($data as $url => $name) {
//            Image::make($url)->save(public_path('assets/brands/' . Str::slug($name) . '.png'));
//        }
//
//        var_dump(888);
//        exit;
//    }
}
