<?php

namespace App\Console\Commands;

use App\Models\TecDoc\GenericArticles;
use App\Models\TecDoc\ShortCuts;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TecDocShortCutsCommand extends TecDocCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tecdoc:short-cuts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate TecDoc Short Cuts';

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
            'getShortCuts2' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
                'articleCountry' => config('tecdoc.api.country'),
                'linkingTargetType' => self::TEC_DOC_TARGET_TYPE_PASSENGER,
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

        ShortCuts::insert($response);

        $this->info('Completed!');
    }
}
