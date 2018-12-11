<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model
{
    protected $fillable =['product_name', 'product_id', 'price', 'quantity', 'size_id', 'color_id'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class);
    }

    public function size()
    {
        return $this->hasOne(Size::class);
    }
}
