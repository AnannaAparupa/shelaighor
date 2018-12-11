<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BlogTag extends Model
{
    public function Posts(){
        return $this->belongsToMany(BlogPost::class, 'blog_post_tags');
    }
}
