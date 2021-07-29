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
        'original_product_no',
        'original_product_name',
        'original_brand_name',
        'price',
        'quantity',
    ];
}
