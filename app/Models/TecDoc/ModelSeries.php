<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSeries extends Model
{
    use HasFactory;

    protected $table = 'td_model_series';

    /**
     * @var array
     */
    protected $fillable = [
        'manuId',
        'modelId',
        'modelname',
        'linkingTargetType',
        'yearOfConstrFrom',
        'yearOfConstrTo',
        'favorFlag',
        'isPopular',
        'isVisible',
        'slug',
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
    public function getLinkingTargetTypeLabelAttribute()
    {
        return '<span class="badge badge-dark">' . $this->linkingTargetType . '</span>';
    }
}
