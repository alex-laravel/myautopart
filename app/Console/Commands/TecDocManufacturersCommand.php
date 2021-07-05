<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;

class TecDocManufacturersCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:manufacturers {linkingTargetType}';

    /**
     * @var string
     */
    protected $description = 'Sync TecDoc Manufacturers';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getManufacturers():
     *
     * Correct linking target type:
     * linkingTargetType=P -> passenger cars
     * linkingTargetType=O -> commercial vehicles
     * linkingTargetType=PO -> both passenger cars and commercial vehicles

     * Favor handling:
     * favouredList=NULL -> all vehicles
     * favouredList=1 -> favorites only
     * favouredList=0 -> Rest
     *
     * @return void
     */
    public function handle()
    {
        $linkingTargetType = $this->argument('linkingTargetType');

        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getManufacturers2' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
                'country' => config('tecdoc.api.country'),
                'linkingTargetType' => $linkingTargetType,
            ]
        ]);

        $this->line($response->body());
    }
}
