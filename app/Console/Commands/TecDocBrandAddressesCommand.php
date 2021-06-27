<?php

namespace App\Console\Commands;

use App\Models\TecDoc\Brand;
use App\Models\TecDoc\BrandAddresses;
use Illuminate\Support\Facades\Http;

class TecDocBrandAddressesCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:brand-addresses';

    /**
     * @var string
     */
    protected $description = 'Generate TecDoc Brand Addresses';

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
        ini_set('max_execution_time', 0);

        $brandIds = Brand::get()->pluck('brandId')->toArray();

        foreach ($brandIds as $brandId) {
            $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
                'getAmBrandAddress' => [
                    'articleCountry' => config('tecdoc.api.country'),
                    'lang' => config('tecdoc.api.language'),
                    'brandNo' => $brandId,
                    'provider' => config('tecdoc.api.provider')
                ]
            ]);

//        var_dump($response->body());

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

            foreach ($response as $address) {
//                BrandAddresses::create($address);
            }

            $this->info('Done for BRAND ID ['. $brandId .']!');
        }

        $this->info('Completed!');
    }
}
