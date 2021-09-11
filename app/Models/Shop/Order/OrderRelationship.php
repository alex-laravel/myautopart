<?php


namespace App\Models\Shop\Order;


use App\Models\Shop\OrderProduct\OrderProduct;
use App\Models\User\User;

trait OrderRelationship
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    /**
//     * @return mixed
//     */
//    public function products()
//    {
//        return $this->hasMany(OrderProduct::class);
//    }
}
