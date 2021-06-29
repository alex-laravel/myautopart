<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'td_manufacturers';

    /**
     * @var array
     */
    protected $fillable = [
        'manuId',
        'manuName',
        'linkingTargetTypes',
        'favorFlag',
        'slug',
        'isPopular',
        'isVisible',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'favorFlag' => 'boolean',
        'isPopular' => 'boolean',
        'isVisible' => 'boolean',
    ];


    /**
     * @return string
     */
    public function getLinkingTargetTypesLabelAttribute()
    {
        return '<span class="badge badge-dark">' . $this->linkingTargetTypes . '</span>';
    }

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
