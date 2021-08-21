<?php

namespace App\Console\Commands;

use App\Models\TecDoc\ArticleIdsWithState;
use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\GenericArticle\GenericArticle;
use App\Models\TecDoc\Vehicle\Vehicle;
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

//        ArticleIdsWithState::truncate();

        $vehicles = Vehicle::orderBy('carId')->get();
        $genericArticleIds = GenericArticle::orderBy('genericArticleId')->get()->pluck('genericArticleId')->toArray();
//        $assemblyGroupIds = AssemblyGroup::get()->pluck('assemblyGroupNodeId')->toArray();

        foreach ($vehicles as $vehicle) {
            foreach (array_chunk($genericArticleIds, 24) as $genericArticleChunk) {
//            foreach ($assemblyGroupIds as $assemblyGroupId) {
                $this->info('Processing for Car ID [' . $vehicle->carId . '] AND chunk Generic Articles [' . implode(",", $genericArticleChunk) . ']!');

                $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
                    'getArticleIdsWithState' => [
                        'provider' => config('tecdoc.api.provider'),
                        'lang' => config('tecdoc.api.language'),
                        'articleCountry' => config('tecdoc.api.country'),
                        'linkingTargetId' => $vehicle->carId,
                        'linkingTargetType' => $vehicle->carType,
//                        'assemblyGroupNodeId' => $assemblyGroupId,
                        'genericArticleId' => [
                            'array' => $genericArticleChunk
                        ],
                        'sort' => 2,
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

                foreach ($response as &$article) {
                    $article['carId'] = $vehicle->carId;
                    $article['carType'] = $vehicle->carType;
                    $article['assemblyGroupNodeId'] = 0;
                }

                ArticleIdsWithState::insert($response);
            }
//            }

            $this->info('Done for Car ID [' . $vehicle->carId . ']!');
        }

        $this->info('Completed!');
    }
}
