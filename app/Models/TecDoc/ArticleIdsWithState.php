<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleIdsWithState extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'td_article_ids_with_state';

    /**
     * @var array
     */
    protected $fillable = [
        'articleId',
        'articleLinkId',
        'articleNo',
        'articleStateId',
        'carId',
        'carType',
        'brandNo',
        'brandName',
        'assemblyGroupNodeId',
        'genericArticleId',
        'genericArticleName',
        'sortNo',
    ];
}
