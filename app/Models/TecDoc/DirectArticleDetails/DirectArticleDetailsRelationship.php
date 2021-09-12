<?php


namespace App\Models\TecDoc\DirectArticleDetails;


use App\Models\DistributorProduct\DistributorProduct;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use App\Models\TecDoc\DirectArticleDocument\DirectArticleDocument;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait DirectArticleDetailsRelationship
{
    /**
     * @return BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(DirectArticle::class, 'articleId', 'articleId');
    }

    /**
     * @return HasMany
     */
    public function documents()
    {
        return $this->hasMany(DirectArticleDocument::class, 'articleId', 'articleId');
    }

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(DistributorProduct::class, 'product_original_no', 'articleNo');
    }
}
