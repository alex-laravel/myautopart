<?php


namespace App\Models\TecDoc\DirectArticle;


use App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait DirectArticleRelationship
{
    /**
     * @return HasOne
     */
    public function details()
    {
        return $this->hasOne(DirectArticleDetails::class, 'articleId', 'articleId');
    }
}
