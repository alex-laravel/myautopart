<?php


namespace App\Models\Shop\OrderProduct;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'sh_order_products';

    /**
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total'
    ];
}
