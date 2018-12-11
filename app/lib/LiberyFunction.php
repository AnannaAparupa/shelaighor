<?php
/**
 * Created by PhpStorm.
 * User: sani
 * Date: 11/28/18
 * Time: 3:15 PM
 */

namespace App\lib;


use App\Color;
use App\Product;
use App\Size;

class LiberyFunction
{
    public static function discountPrice($price, $discount=0)
    {
        return $newprice = $price -($price*($discount/100));

    }

    public static function randonGenerate()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000, 9999)
            . mt_rand(100, 999);
        $ch = $characters[rand(0, strlen($characters)) -1];
        $ch2 = $characters[rand(0, strlen($characters)) -1];
        $string = str_shuffle($pin);
        return $ch.$ch2.'-'.$pin;
    }

    public static function findColor($id)
    {
        $color = Color::find($id);
        return $color->color_name;
    }

    public static function findSize($id)
    {
        $size = Size::find($id);
        return $size->size_name;
    }

    public static function findProduct($id)
    {
        $product = Product::find($id);
        return $product->sku;
    }
}