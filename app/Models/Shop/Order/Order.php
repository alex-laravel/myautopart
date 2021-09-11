<?php


namespace App\Models\Shop\Order;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use OrderRelationship;

    const ORDER_STATUS_PENDING = 'pending';
    const ORDER_STATUS_PROCESSING = 'processing';
    const ORDER_STATUS_COMPLETED = 'completed';
    const ORDER_STATUS_DECLINE = 'decline';

    /**
     * @var string
     */
    protected $table = 'sh_orders';

    /**
     * @var array
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'quantity',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'phone_number',
        'first_name',
        'last_name',
        'city',
        'country',
        'post_code',
        'address',
        'notes',
    ];
}
