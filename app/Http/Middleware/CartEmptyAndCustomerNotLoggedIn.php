<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cart;

class CartEmptyAndCustomerNotLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customer')->check() )
        {
            return \redirect()->to('/login');
        }else if (Cart::isEmpty()){
            return \redirect()->to('/shop');
        }else{
            return $next($request);
        }

    }
}
