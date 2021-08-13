<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    const TEC_DOC_TARGET_TYPE_PASSENGER = 'P';
    const TEC_DOC_TARGET_TYPE_COMMERCIAL = 'O';
    const TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT = 'L';
    const TEC_DOC_TARGET_TYPE_AXLES = 'A';
    const TEC_DOC_TARGET_TYPE_MOTOR = 'M';
    const TEC_DOC_TARGET_TYPE_BODY = 'K';
    const TEC_DOC_TARGET_TYPE_UNIVERSAL = 'U';
    const TEC_DOC_TARGET_TYPE_MOTORCYCLES = 'B';

    /**
     * @var string[]
     */
    public static $allowedTargetTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT,
        self::TEC_DOC_TARGET_TYPE_AXLES,
        self::TEC_DOC_TARGET_TYPE_MOTOR,
        self::TEC_DOC_TARGET_TYPE_BODY,
        self::TEC_DOC_TARGET_TYPE_UNIVERSAL
    ];

    /**
     * @var string[]
     */
    public static $allowedVehicleTargetTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT,
        self::TEC_DOC_TARGET_TYPE_UNIVERSAL
    ];

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
