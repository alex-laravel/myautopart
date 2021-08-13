<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;

class TecDocDirectArticlesCommand extends TecDocCommand
{
    /**
     * @var string
     */
    protected $signature = 'tecdoc:direct-articles {linkingTargetId} {linkingTargetType} {brandIds*}';

    /**
     * @var string
     */
    protected $description = 'Generate TecDoc Direct Articles';

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
        $linkingTargetId = $this->argument('linkingTargetId');
        $linkingTargetType = $this->argument('linkingTargetType');
        $brandIds = $this->argument('brandIds');

        \Log::debug('CALL COMMAND [tecdoc:direct-articles]');

        $response = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->post(config('tecdoc.api.url'), [
            'getArticleIdsWithState' => [
                'provider' => config('tecdoc.api.provider'),
                'lang' => config('tecdoc.api.language'),
                'articleCountry' => config('tecdoc.api.country'),
                'linkingTargetType' => $linkingTargetType,
                'linkingTargetId' => $linkingTargetId,
                'brandNo' => [
                    'array' => $brandIds
                ],
                'sort' => 2,
            ]
        ]);

        $this->line($response->body());
    }
}
