<?php

namespace App\Models\TecDoc\DirectArticle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectArticle extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'td_direct_articles';

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
        'genericArticleId',
        'genericArticleName',
        'sortNo',
    ];
}
