<?php

namespace App\Models\TecDoc\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    use VehicleRelationship;

    protected $table = 'td_vehicles';

    /**
     * @var array
     */
    protected $fillable = [
        'manuId',
        'modelId',
        'carId',
        'carName',
        'firstCountry',
        'slug',
    ];
}
