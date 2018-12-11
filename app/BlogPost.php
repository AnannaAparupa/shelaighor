<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class BlogPost extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function (Builder $builder){
            if(Auth::check())
            {
                if (Auth::user()->role_id == \env('ADMIN_ROLE_ID')){
                    return;
                }else{
                    $builder->where('user_id', Auth::user()->id);
                }
            }
        });

    }

    public function save(array $options = []){
        $this->user_id = Auth::user()->id;
        parent::save();
    }


    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags(){
        return $this->belongsToMany(BlogTag::class, 'blog_post_tags');
    }
    public function user()
    {
        return $this->belongsTo(\TCG\Voyager\Models\User::class, 'user_id');
    }
}
