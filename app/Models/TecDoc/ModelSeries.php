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
        'yearOfConstrFrom',
        'yearOfConstrTo'
    ];
}
