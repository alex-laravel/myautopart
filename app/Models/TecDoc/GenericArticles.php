<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenericArticles extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'td_generic_articles';

    /**
     * @var array
     */
    protected $fillable = [
        'genericArticleId',
        'assemblyGroup',
        'designation',
        'masterDesignation',
        'usageDesignation'
    ];
}
