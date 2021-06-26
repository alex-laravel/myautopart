<?php

namespace App\Models\TecDoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandAddresses extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'td_brand_addresses';

    /**
     * @var array
     */
    protected $fillable = [
        'addressName',
        'addressType',
        'city',
        'fax',
        'logoDocId',
        'name',
        'phone',
        'street',
        'wwwURL',
        'zip',
        'zipCountryCode',
    ];
}
