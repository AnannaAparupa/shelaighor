<?php

namespace App\Http\Controllers\Api;

use App\BlogCategory;
use App\BlogPost;
use App\BlogTag;
use App\Category;
use App\User;
use Debugbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function posts()
    {
        $posts = BlogPost::with(['tags', 'category', 'user'])->paginate(15);
        return \response()->json([
            'posts'=>$posts
        ], 200);

    }

    public function categories()
    {
        $categories = BlogCategory::all();
        return \response()->json([
            'categories'=>$categories
        ], 200);
    }

    public function tags()
    {
        $tags = BlogTag::with('Posts')->get();

        return \response()->json([
            'tags'=>$tags
        ], 200);
    }

    public function PostsByTag($slug){
        $posts = BlogPost::whereHas('tags', function ($q) use($slug) {
            $q->where('tag_slug', $slug);
        })->with(['category', 'user'])->paginate(15);
        return \response()->json([
            'posts'=>$posts
        ], 200);
    }

    public function PostsByCategory($slug){
        $posts = BlogPost::whereHas('category', function ($q) use($slug) {
            $q->where('category_slug', $slug);
        })->with(['tags', 'user'])->paginate(15);
        return \response()->json([
            'posts'=>$posts
        ], 200);
    }
    public function BlogBySlug($slug)
    {
        $posts = BlogPost::where('blog_slug', $slug)
            ->with(['tags', 'category', 'user'])
            ->first();
        return \response()->json([
            'posts'=>$posts
        ], 200);
    }
}
