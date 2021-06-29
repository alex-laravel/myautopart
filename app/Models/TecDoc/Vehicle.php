<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'td_vehicles';

    /**
     * @var array
     */
    protected $fillable = [
        'manuId',
        'modelId',
        'carId',
        'carName',
        'carType',
        'firstCountry',
        'slug',
    ];

    /**
     * @return string
     */
    public function getCarTypeLabelAttribute()
    {
        return '<span class="badge badge-dark">' . $this->carType . '</span>';
    }
}
