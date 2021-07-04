<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Http;

class TecDocGenericArticleCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:generic-articles';

    /**
     * @var string
     */
    protected $description = 'Generate TecDoc Generic Articles';

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
        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getGenericArticles' => [
                'articleCountry' => config('tecdoc.api.country'),
                'lang' => config('tecdoc.api.language'),
                'provider' => config('tecdoc.api.provider'),
                'searchTreeNodes' => true
            ]
        ]);

        $this->line($response->body());
    }
}
