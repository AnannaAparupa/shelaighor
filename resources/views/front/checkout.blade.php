@extends('front.include.master')
@section('content')
    @include('front.include.bannar', ['breadcrumb2'=>'Checkout'])

    <main class="mainContent">
        <section id="pageContent">
            <div class="container">
                <div class="wpbAccountContainer">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::get('Message'))
                                <div class="col-md-12">
                                    <p class="alert alert-dismissable alert-success">{{ Session::get('Message') }}</p>
                                </div>
                            @endif
                        </div>
                        <form method="post" action="{{ url('/checkout-final') }}" id="customer_login" accept-charset="UTF-8"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />

                            <div class="col-xs-12 col-sm-6">
                            <div class="formAccount formLogin">

                                <div id="CustomerLoginForm" class="formAccountLogin">
                                    <h1 class="wpbAccountTitle">Shipping Details</h1>
                                    <div class="formContent">
                                            @csrf 
                                            <div class="form-group">
                                                <label for="shipping" class="">Shipping Address</label>
                                                <input type="text" name="shipping_address" id="shipping" class="form-control" placeholder="Enter Shipping Address" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="payment_type" class="">Payment Type </label>

                                                <input type="radio" name="payment_type" id="payment_type" checked value="cod"> Cash On delivery
                                            </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="formAccount formLogin">
                                <h3 class="wpbAccountTitle">Want to modify your dress ???</h3>
                                <div class="formContent">
                                    <p>* If you want to modify your dress you need to pay extra. Trailer will call you</p>
                                    <div class="form-group">
                                        <label for="modifier" class="">Send To modifier  </label>
                                        <input type="checkbox" name="send_to_modifier" id="modifier" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="modifier_id" class="">Select Modifier</label>
                                        <select name="modifier_id" id="modifier_id" class="form-control">
                                            @foreach( $users as $user)
                                            <option value="{{ $user->id }}">{{ $user->shop_name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="measurement" class="">Measurement</label>
                                        <textarea name="measurement" id="measurement" cols="30" rows="10" class="form-control" placeholder="Measurement of your chest, soulder, hand, long etc..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <p><input type="submit" class="btn btnWpbingoOne pull-right" value="Submit your order"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection