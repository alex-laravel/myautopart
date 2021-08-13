<?php


namespace App\Models\TecDoc\Manufacturer;


use Illuminate\Database\Eloquent\Builder;

trait ManufacturerScope
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyIsFavorite($query)
    {
        return $query->where('favorFlag', true);
    }
}
