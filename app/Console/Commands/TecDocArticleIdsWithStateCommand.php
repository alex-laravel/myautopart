<?php

namespace App\Console\Commands;

use App\Models\TecDoc\ArticleIdsWithState;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\Vehicle;
use Illuminate\Support\Facades\Http;

class TecDocArticleIdsWithStateCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:articles-with-states';

    /**
     * @var string
     */
    protected $description = 'Generate TecDoc Article IDS with States';

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

        $vehicleIds = Vehicle::orderBy('carId')->get()->pluck('carId')->toArray();
        $brandIds = Brand::get()->pluck('brandId')->toArray();

        foreach ($vehicleIds as $vehicleId) {
            foreach (array_chunk($brandIds, 30) as $brandIdsChunk) {
                $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
                    'getArticleIdsWithState' => [
                        'articleCountry' => config('tecdoc.api.country'),
                        'lang' => config('tecdoc.api.language'),
                        'linkingTargetType' => 'P',
                        'linkingTargetId' => $vehicleId,
                        'brandNo' => [
                            'array' => $brandIdsChunk
                        ],
                        'provider' => config('tecdoc.api.provider'),
                        'sort' => 1,
                    ]
                ]);

    //        var_dump($response->body());

                $response = $response->json();

                if (!$this->hasSuccessResponse($response)) {
                    var_dump($response['status'], $response['statusText']);
                    $this->warn($response['status'] . ' - ' . $response['statusText']);
                    continue;
                }

                $response = $this->getResponseDataAsArray($response);

                if (empty($response)) {
                    $this->warn('Empty response!');
                    continue;
                }

                foreach ($response as &$article) {
                    $article['carId'] = $vehicleId;
                }

                ArticleIdsWithState::insert($response);
            }

            $this->info('Done for Car ID ['. $vehicleId .']!');
        }


        $this->info('Completed!');
    }
}
