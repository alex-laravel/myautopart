<?php

namespace App\Console\Commands;

use App\Models\TecDoc\DirectArticleDocument\DirectArticleDocument;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TecDocDirectArticlesDocumentsCommand extends TecDocCommand
{
    const ARTICLE_DOCUMENTS_STORAGE_NAME = 'articles';

    /**
     * @var string
     */
    protected $signature = 'tecdoc:direct-articles-documents {articleId} {articleDocId} {articleDocTypeId} {--thumbnail}';

    /**
     * @var string
     */
    protected $description = 'Sync TecDoc Direct Article Documents';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return boolean
     */
    public function handle()
    {
        \Log::debug('CALL COMMAND [tecdoc:direct-articles-documents]');

        $articleId = (int)$this->argument('articleId');
        $articleDocId = $this->argument('articleDocId');
        $articleDocTypeId = (int)$this->argument('articleDocTypeId');
        $thumbnail = (int)$this->option('thumbnail');

        $responseDocument = Http::withHeaders(['X-Api-Key' => config('tecdoc.api.key')])->get(config('tecdoc.asset.url') . '/' . config('tecdoc.api.provider') . '/' . $articleDocId . '/' . $thumbnail);

        if ($responseDocument->ok()) {
            $documentName = $this->generateDirectArticleDocumentName($responseDocument->header('Content-Type'), $articleId . $articleDocId . $thumbnail);

            DirectArticleDocument::create([
                'articleId' => $articleId,
                'articleDocId' => $articleDocId,
                'articleDocTypeId' => $articleDocTypeId,
                'assetDocumentName' => $documentName,
                'isThumbnail' => $thumbnail,
            ]);

            Storage::disk(self::ARTICLE_DOCUMENTS_STORAGE_NAME)->put($documentName, $responseDocument->body());
        }

        $this->line(true);
        return true;
    }

    /**
     * @param string $mimeType
     * @return string
     */
    private function getExtension($mimeType)
    {
        $extensions = [
            'image/gif' => 'gif',
            'image/jpeg' => 'jpg',
            'image/png' => 'png'
        ];

        return array_key_exists($mimeType, $extensions) ? $extensions[$mimeType] : 'tmp';

    }

    /**
     * @param string $header
     * @param string $name
     * @return string
     */
    private function generateDirectArticleDocumentName($header, $name)
    {
        return md5($name) . '.' . $this->getExtension($header);

    }
}
