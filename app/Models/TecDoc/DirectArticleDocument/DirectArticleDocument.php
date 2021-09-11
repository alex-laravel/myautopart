<?php


namespace App\Models\TecDoc\DirectArticleDocument;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectArticleDocument extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'td_direct_article_documents';

    /**
     * @var array
     */
    protected $fillable = [
        'articleId',
        'articleDocId',
        'articleDocTypeId',
        'assetDocumentName',
        'isThumbnail',
    ];
}
