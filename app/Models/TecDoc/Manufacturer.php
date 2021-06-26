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
        'slug',
        'isVisible',
        'isPopular',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'isVisible' => 'boolean',
        'isPopular' => 'boolean',
    ];
}
