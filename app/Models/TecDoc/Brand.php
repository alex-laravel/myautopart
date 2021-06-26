<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'td_brands';

    /**
     * @var array
     */
    protected $fillable = [
        'brandId',
        'brandLogoID',
        'brandName',
    ];
}
