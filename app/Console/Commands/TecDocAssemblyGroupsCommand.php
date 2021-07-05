<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;

class TecDocAssemblyGroupsCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:assembly-groups {shortCutId} {linkingTargetType}';

    /**
     * @var string
     */
    protected $description = 'Sync TecDoc Assembly Groups';

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
//        $shortCutId = (int)$this->argument('shortCutId');
//
        $linkingTargetType = $this->argument('linkingTargetType');

        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getChildNodesAllLinkingTarget2' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
                'linkingTargetType' => $linkingTargetType,
                'childNodes' => true,
//                'shortCutId' => $shortCutId
            ]
        ]);

        $this->line($response->body());
    }
}
