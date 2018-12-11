@extends('front.include.master')
@section('content')

    @include('front.include.bannar', ['breadcrumb2'=>'Shopping Cart'])

    <main class="mainContent">
        <section id="pageContent">
            <div class="container">
                <div id="shopify-section-wpb-template-cart" class="shopify-section"><div class="cartContainer">
                        @if(Session::get('Message'))
                            <div class="col-md-12">
                                <p class="alert alert-dismissable alert-success">{{ Session::get('Message') }}</p>
                            </div>
                        @endif
                        <h1 class="cartTitle">Shopping cart</h1>
                        <div class="cartContent">


                                <div class="cartTable">
                                    <table class="cartHeaderLabels">
                                        <thead>
                                        <tr>
                                            <th><span class="headerLabels">Image</span></th>
                                            <th><span class="headerLabels">Product</span></th>
                                            <th><span class="headerLabels">Price</span></th>
                                            <th><span class="headerLabels">Quantity</span></th>
                                            <th><span class="headerLabels">Total</span></th>
                                            <th><span class="headerLabels">&nbsp;</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($carts as $cart)
                                        <tr>
                                            <td>
                                                <a href="{{ url('/product-details/'.str_slug($cart->name)) }}" class="cartImage">
                                                    <img style="width:150px; height: 150px; " src="{{ Voyager::image($cart->attributes->image) }}" alt="{{ $cart->name }}">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/product-details/'.str_slug($cart->name)) }}" class="productName">
                                                    {{ $cart->name }}
                                                </a>




                                            </td>
                                            <td>
										<span class="priceProduct">
											{{ setting('site.currency') }} {{ $cart->price }}
										</span>
                                            </td>
                                            <td>
                                                {{ $cart->quantity }}
                                                </td>
                                            <td>
										<span class="h3 cartSubtotal priceProduct">
                                        {{ setting('site.currency') }} {{ $cart->getPriceSum() }}
										</span>
                                            </td>
                                            <td>
                                                <a href="{{ url('/cart/remove/'.$cart->id) }}" class="cartRemove" title="Remove">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                            @empty
                                            <p>There is no product in the cart</p>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <div class="functionCart row noGutter">

                                    <div class="text-right col-xs-12">
                                        <p>
                                            <span class="cartSubtotalTitle">Total</span>
                                            <span class="h3 cartSubtotal">{{ setting('site.currency') }} {{ Cart::getTotal()}}</span>
                                        </p>
                                        <p><em>Shipping &amp; taxes calculated at checkout</em></p>
                                        <a href="{{ url('/shop') }}" class="btn btnWpbingoOne btnUpdateCart" value="Update Cart">Continue Shopping</a>
                                        <a href="{{ url('/checkout') }}" class="btn btnWpbingoOne btnUpdateCart" value="Update Cart">Checkout</a>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection