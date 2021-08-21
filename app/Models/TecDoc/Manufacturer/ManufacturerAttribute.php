<?php


namespace App\Models\TecDoc\Manufacturer;


trait ManufacturerAttribute
{
    /**
     * @return string
     */
    public function getIsFavoriteLabelAttribute()
    {
        return $this->favorFlag
            ? '<span class="badge badge-info">F</span>'
            : '';
    }

    /**
     * @return string
     */
    public function getIsPopularLabelAttribute()
    {
        return $this->isPopular
            ? '<span class="badge badge-success">Yes</span>'
            : '<span class="badge badge-warning">No</span>';
    }

    /**
     * @return string
     */
    public function getIsVisibleLabelAttribute()
    {
        return $this->isVisible
            ? '<span class="badge badge-success">Yes</span>'
            : '<span class="badge badge-warning">No</span>';
    }
}
