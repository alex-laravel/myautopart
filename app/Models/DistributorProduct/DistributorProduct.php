<?php

namespace App\Models\DistributorProduct;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorProduct extends Model
{
    use HasFactory;
    use DistributorProductAttribute;

    /**
     * @var string
     */
    protected $table = 'sh_distributor_products';

    /**
     * @var array
     */
    protected $fillable = [
        'distributor_storage_id',
        'product_barcode',
        'product_original_no',
        'product_local_no',
        'product_local_name',
        'product_band_name',
        'price',
        'quantity',
    ];
}
