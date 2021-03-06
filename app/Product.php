<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function (Builder $builder){
            if(Auth::check())
            {
                if (Auth::user()->role_id == \env('ADMIN_ROLE_ID') || Auth::user()->role_id == \env('MODIFIER_ROLE_ID')){
                    return;
                }else{

                    $builder->where('user_id', Auth::user()->id);
                }
            }
        });

    }

    public function save(array $options = [])
    {
        $this->sku = $this->randonGenerate();
        $this->user_id = Auth::user()->id;
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    public function randonGenerate()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000, 9999)
            . mt_rand(100, 999);
        $ch = $characters[rand(0, strlen($characters)) -1];
        $ch2 = $characters[rand(0, strlen($characters)) -1];
        $string = str_shuffle($pin);
        return $ch.$ch2.'-'.$pin;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(\TCG\Voyager\Models\User::class, 'user_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'products_colors');
    }

    public function sizes ()
    {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }
}
