<?php

namespace App\Console\Commands;

use App\Models\TecDoc\GenericArticles;
use Illuminate\Support\Facades\Http;

class TecDocGenericArticlesCommand extends TecDocCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tecdoc:generic-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate TecDoc Generic Articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getGenericArticles' => [
                'articleCountry' => config('tecdoc.api.country'),
                'lang' => config('tecdoc.api.language'),
                'provider' => config('tecdoc.api.provider'),
                'searchTreeNodes' => true,
            ]
        ]);

//        var_dump($response->body());

        $response = $response->json();

        if (!$this->hasSuccessResponse($response)) {
            return;
        }

        $response = $this->getResponseDataAsArray($response);

        if (empty($response)) {
            return;
        }

        foreach ($response as $genericArticle) {
            if (!array_key_exists('assemblyGroup', $genericArticle)) {
                $genericArticle['assemblyGroup'] = null;
            }

            if (!array_key_exists('designation', $genericArticle)) {
                $genericArticle['designation'] = null;
            }

            if (!array_key_exists('masterDesignation', $genericArticle)) {
                $genericArticle['masterDesignation'] = null;
            }

            if (!array_key_exists('usageDesignation', $genericArticle)) {
                $genericArticle['usageDesignation'] = null;
            }

            GenericArticles::create([
                'genericArticleId' => $genericArticle['genericArticleId'],
                'assemblyGroup' => $genericArticle['assemblyGroup'],
                'designation' => $genericArticle['designation'],
                'masterDesignation' => $genericArticle['masterDesignation'],
                'usageDesignation' => $genericArticle['usageDesignation']
            ]);
        }

//        GenericArticles::insert($response);

        $this->info('Completed!');

//        var_dump('<pre>');
//        var_dump($response->json());
//        var_dump('</pre>');
//        exit;
    }
}
