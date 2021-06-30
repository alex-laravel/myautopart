<?php

namespace App\Console\Commands;

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

//                'linked' => true,
//                'linkingTargetId' => 2,
            ]
        ]);

        $this->line($response->body());
    }
}
