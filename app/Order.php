<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable =['customer_id', 'total', 'payment_type', 'send_to_modifier', 'measurement', 'shipping_address', 'modifier_id'];

    public function orderDetails()
    {
        return $this->belongsToMany(OrderDetail::class, 'orders_order_details', 'order_detail_id', 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function modifier()
    {
        return $this->belongsTo(User::class, 'modifier_id');
    }
}
