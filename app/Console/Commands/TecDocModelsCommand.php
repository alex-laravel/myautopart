<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;

class TecDocModelsCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:models';

    /**
     * @var string
     */
    protected $description = 'Sync TecDoc Models';

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
            'getCountries' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
            ]
        ]);

        $this->line($response->body());
    }
}
