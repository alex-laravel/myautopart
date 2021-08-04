<?php


namespace App\Models\DistributorProduct;


use App\Models\DistributorStorage\DistributorStorage;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait DistributorProductRelationship
{
    /**
     * @return HasMany
     */
    public function distributorStorage()
    {
        return $this->belongsTo(DistributorStorage::class);
    }
}
