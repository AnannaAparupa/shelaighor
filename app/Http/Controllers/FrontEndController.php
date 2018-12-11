<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\BlogPost;
use App\BlogTag;
use App\Category;
use App\Color;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Size;
use App\Slider;
use App\Tag;
use function foo\func;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\User;

class FrontEndController extends Controller
{
    public function actionHome()
    {
        $sliders = Slider::all();
        $featuredProducts = Product::where('featured_product', 1)->limit(6)->get();
        $latestNews = BlogPost::orderBy('id', 'desc')->with('user')->limit(8)->get();
        $newArraivls = Product::orderBy('id', 'desc')->limit(6)->get();
        return \view('front.home', [
            'sliders'=>$sliders,
            'featuredProducts'=>$featuredProducts,
            'latestNews'=>$latestNews,
            'newArraivls'=>$newArraivls
        ]);
    }

    public function actionShop(Request $request)
    {
        $categories = Category::orderBy('category_title', 'asc')->get();

        $shopHeader = "Shop";
        $category = $request->category;

        if ($category)
        {
            $products = Product::whereHas('category', function ($q) use ($category){
                $q->where('category_slug', $category);
            })->orderBy('id', 'desc')->paginate(16);
            $shopHeader = $category;
        }else{
            $products = Product::orderBy('id', 'desc')->paginate(16);
        }
        return \view('front.shop', [
            'categories'=>$categories,
            'products'=>$products,
            'shopHeader'=>\ucfirst($shopHeader),
        ]);
    }

    public function actionProductDetails($slug)
    {

        $product = Product::where('slug', $slug)->with(['user', 'category', 'tags', 'colors', 'sizes'])->first();
        $category_id = $product->category->id;
        $related_product = Product::whereHas('category', function ($q) use ($category_id){
            $q->where('id', $category_id);
        })->with(['user', 'category', 'tags', 'colors', 'sizes'])->get();

        return \view('front.productDetails', [
            'product'=>$product,
            'related_product'=>$related_product
        ]);
    }

    public function actionBlogs(Request $request)
    {
        $categories = BlogCategory::orderBy('category_name', 'asc')->get();
        $recent_posts = BlogPost::orderBy('id', 'desc')->limit(4)->get();
        $tags = BlogTag::orderBy('tag_title', 'asc')->get();

        $category = $request->get('category');
        $tag = $request->get('tag');
        $blog_header = "Blogs";
        if ($category)
        {

            $blogs = BlogPost::whereHas('category', function ($query) use ($category){
                $query->where('category_slug', $category);
            })->paginate(12);
            $blog_header = $category;
        }else if ($tag)
        {
            $blogs = BlogPost::whereHas('tags', function ($query) use ($tag){
                $query->where('tag_slug', $tag);
            })->paginate(12);

            $blog_header = $tag;
        }else{
            $blogs = BlogPost::orderBy('id', 'desc')->with('user')->paginate(12);
        }




        return \view('front.blog', [
            'categories'=>$categories,
            'recent_posts'=>$recent_posts,
            'tags'=>$tags,
            'blogs'=>$blogs,
            'blog_header'=>\ucfirst($blog_header)
        ]);
    }

    public function actionBlogDeatils($slug)
    {
        $blog = BlogPost::where('blog_slug', $slug)->with(['category', 'tags', 'user'])->first();

        return \view('front.blogDetails', [
            'blog'=>$blog
        ]);
    }

    public function addProductTocart(Request $request)
    {
        Cart::add($request->product_id, $request->product_name, $request->product_price, $request->qty, [
            'size'=>$request->size,
            'color'=>$request->color,
            'image'=>$request->image
        ]);
        return \redirect()->back()->with('Message', $request->product_name.' added to cart');

    }

    public function actionCart()
    {
        $carts = Cart::getContent();
        return \view('front.cart', [
            'carts'=>$carts
        ]);
    }

    public function actionCartRemove($id)
    {
        Cart::remove($id);
        return \redirect()->back()->with('Message', 'Item Removed From Cart');
    }

    public function actionCheckout()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'modifier');
        })->with('role')->get();

        return \view('front.checkout', [
            'users'=>$users
        ]);
    }

    public function actionCheckoutFinal(Request $request)
    {
        $this->validate($request, [
            'shipping_address'=>'required|max:191'
        ]);

        if ($request->send_to_modifier)
        {
            $this->validate($request, [
                'send_to_modifier'=>'required',
                'modifier_id'=>'required',
                'measurement'=>'required',
            ]);
        }

        $carts = Cart::getContent();

        $order = new Order();
        $order->customer_id = Auth::guard('customer')->user()->id;
        $order->total = Cart::getTotal();
        $order->payment_type = $request->payment_type;
        $order->send_to_modifier= $request->send_to_modifier?$request->send_to_modifier:0;
        $order->measurement = $request->measurement;
        $order->shipping_address = $request->shipping_address;
        $order->modifier_id = $request->modifier_id;
        $order->save();
        foreach ($carts as $cart)
        {
            $order_details = OrderDetail::create([
                'product_id'=>$cart->id,
                'product_name'=>$cart->name,
                'price'=>$cart->price,
                'quantity'=>$cart->quantity,
                'size_id'=>$cart->attributes->size,
                'color_id'=>$cart->attributes->color,
            ]);

            Product::where('id', $cart->id)->decrement('stock', $cart->quantity);
            $order->orderDetails()->attach($order_details->id);
        }
        Cart::clear();

        return \redirect()->to('/');

    }
}
