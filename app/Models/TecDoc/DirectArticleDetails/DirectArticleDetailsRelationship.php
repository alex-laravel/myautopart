<?php


namespace App\Models\TecDoc\DirectArticleDetails;


use App\Models\TecDoc\DirectArticle\DirectArticle;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait DirectArticleDetailsRelationship
{
    /**
     * @return BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(DirectArticle::class, 'articleId', 'articleId');
    }
}
