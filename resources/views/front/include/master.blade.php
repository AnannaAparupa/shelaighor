<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#7796A8">
    <link rel="stylesheet" href="{{ asset('front') }}/css/material-design-iconic-font.min.css">
    <link rel="shortcut icon" href="{{ asset('front') }}/img/favicon_32x32adfc.png?v=1535624103" type="image/png">
    <title>SUI-GHOR</title>
    <link href="{{ asset('front') }}/css/font/cssd087.css?family=Hind:100,300,400,500,700" rel="stylesheet" type="text/css">
    <link href="{{ asset('front') }}/css/font/css5a5d.css?family=Dosis:100,300,400,500,700" rel="stylesheet" type="text/css">
    <link href="{{ asset('front') }}/css/font/cssffb4.css?family=Rubik" rel="stylesheet">
    <link href="{{ asset('front') }}/css/assets/wpb-fonts.scssd92a.css?4767156002400401035" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('front') }}/css/assets/wpb-site.scssd92a.css?4767156002400401035" rel="stylesheet" type="text/css" media="all" />
    <script src="{{ asset('front') }}/js/preview_bar_injector-2e3b1ec6ae5e95d411b9d31d964c9fe97d9d775fcd4565a39968ae4e66f58adb.js"></script>
    <script src="{{ asset('front') }}/css/assets/jquery.2.2.3d92a.js?4767156002400401035" type="text/javascript"></script>
{{--<script>--}}
{{--window.money = '${{amount}}';--}}
{{--window.money_format = '${{amount}} USD';--}}
{{--window.currency = 'USD';--}}
{{--window.shop_currency = 'USD';--}}
{{--window.shop_money_format = "${{amount}}";--}}
{{--window.shop_money_with_currency_format = "${{amount}} USD";--}}
{{--window.loading_url = './css/assets/loadingd92a.gif?4767156002400401035';--}}
{{--window.file_url = './img/?4767156002400401035';--}}
{{--window.asset_url = './css/assets/?4767156002400401035';--}}
{{--window.ajaxcart_type = 'modal';--}}
{{--window.swatch_enable = false;--}}
{{--window.sidebar_multichoise = true;--}}
{{--window.float_header = false;--}}
{{--window.review = true;--}}
{{--window.currencies = true;--}}
{{--window.countdown_format = '<ul class="list-unstyle list-inline"><li><span class="number">%D</span></li><li><span class="number">%H</span></li><li><span class="number">%M</span></li><li><span class="number">%S</span></li></ul>';--}}
{{--</script>--}}

<!-- <div id="loadingSite">
  <div class="loader"></div>
</div> -->

    <style>
        .shopify-payment-button__button--hidden {
            visibility: hidden;
        }

        .shopify-payment-button__button {
            border-radius: 4px;
            border: none;
            box-shadow: 0 0 0 0 transparent;
            color: white;
            cursor: pointer;
            display: block;
            font-size: 1em;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            width: 100%;
            transition: background 0.2s ease-in-out;
        }

        .shopify-payment-button__button[disabled] {
            opacity: 0.6;
            cursor: default;
        }

        .shopify-payment-button__button--unbranded {
            background-color: #1990c6;
            padding: 1em 2em;
        }

        .shopify-payment-button__button--unbranded:hover:not([disabled]) {
            background-color: #136f99;
        }

        .shopify-payment-button__more-options {
            background: transparent;
            border: 0 none;
            cursor: pointer;
            display: block;
            font-size: 1em;
            margin-top: 1em;
            text-align: center;
            width: 100%;
        }

        .shopify-payment-button__more-options:hover:not([disabled]) {
            text-decoration: underline;
        }

        .shopify-payment-button__more-options[disabled] {
            opacity: 0.6;
            cursor: default;
        }

        .shopify-payment-button__button--branded {
            display: flex;
            flex-direction: column;
            min-height: 44px;
            position: relative;
            z-index: 1;
        }

        .shopify-payment-button__button--branded .shopify-cleanslate {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
        }
    </style>

    <script integrity="sha256-tktEFIGLNKynPir1LpzrxF6FtKdUgas1Q0dwY8CRLfs=" defer="defer" src="{{asset('front')}}/js/express_buttons-b64b4414818b34aca73e2af52e9cebc45e85b4a75481ab3543477063c0912dfb.js" crossorigin="anonymous"></script>
    <script integrity="sha256-NfqRkSQwKw0JfNupCky6Zxtoijw8YUA8km/3gYu7kY8=" defer="defer" src="{{asset('front')}}/js/features-35fa919124302b0d097cdba90a4cba671b688a3c3c61403c926ff7818bbb918f.js" crossorigin="anonymous"></script>

</head>
<!-- add class "template-blog" when the page is for blog -->
<body id="fashow-minimal-and-modern-shopify-theme" class="template-index template-blog template-article template-customers/register template-customers/login">

<div id="cartDrawer" class="ajaxCartModal modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="wpbCartTitle">
                <span>Shopping cart</span>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div id="cartContainer"></div>
        </div>
    </div>
</div>


<div id="pageContainer" class="isMoved">
    <div id="shopify-section-wpb-header" class="shopify-section">
        <header id="wpbHeader" class="wpbHeader" >
            <section class="headerWrap">
                <div id="wpbHeaderMain" class="header-center" style="background-color: rgba(0,0,0,0);">
                    <div class="container">
                        <div class="row">
                            <div class="headerContent flexRow">
                                <div class="wpbHeaderLeft hidden-xs col-sm-6 col-md-4 col-lg-4">
                                    <div class="html-hotline">
                                        <p>
                                            <i class="fa fa-phone"></i>
                                            <span>Hotline:</span>(+880)-123456789
                                        </p>
                                    </div>
                                </div>
                                <div class="wpbHeaderCenter col-xs-6 col-sm-12 col-md-4 col-lg-4">
                                    <h1 class="wpbLogo" itemscope itemtype="http://schema.org/Organization">
                                        <a href="{{ url('/') }}" itemprop="url" class="wpbLogoLink">
                                            <img class="img-responsive" src="{{ asset('front') }}/img/logo.jpeg?v=1535706929" alt="Sheli Ghor" itemprop="logo" style="width: 59%; height: 75px;">
                                        </a>
                                    </h1>
                                </div>
                                <div class="wpbHeaderRight col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="wpbIconTopLink">
                                        @if(Auth::guard('customer')->check())
                                            <a class="wpbIconTopLinks" href="{{ url('/my-account') }}" data-toggle="collapse">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            @else
                                            <a class="wpbIconTopLinks" href="{{ url('/login') }}" data-toggle="collapse">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            @endif

                                        {{--<div  id="wpbTopLinks" class="wpbTopLinks collapse">
                                            <ul  class="list-unstyled">

                                                <li><a href="{{ url('/register') }}" id="customer_register_link">Register</a></li>
                                                <li><a href="{{ url('/login') }}" id="customer_login_link">Login</a></li>

                                                <li><a href="{{ url('/wishlist') }}" title="Wishlist">Wishlist</a></li>
                                                <li><a href="{{ url('/cart') }}" title="Check out">Check out</a></li>
                                            </ul>
                                        </div>--}}
                                    </div>
                                    
                                    <div class="wpbCartTop">
                                        <a href="{{ url('/cart') }}">
                                            <span class="icon ion-bag"></span>
                                        </a>
                                        <span id="CartCount" class="cart-products-count">{{ Cart::getContent()->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wpbHeaderBottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-2 col-xs-4 wpbHeaderMenu">


                                <div class="menuBtnMobile pull-left hidden-md hidden-lg">
                                    <div id="btnMenuMobile" class="btnMenuMobile">
                                        <span class="menu-item">Menu</span>
                                    </div>
                                </div>

                                <div id="wpbMegamenu" class="wpbMegamenu hidden-xs hidden-sm">
                                    <nav class="menuContainer">
                                        <ul class="nav hidden-xs hidden-sm">
                                            <li class="active">
                                                <a href="{{ url('/') }}" title="">Home</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/shop') }}" title="">Shop</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/blog') }}" title="">Blog</a>
                                            </li>
                                            {{--<li>
                                                <a href="modifier.php" title="">Modifier</a>
                                            </li>
                                            <li>
                                                <a href="designer.php" title="">Designer</a>
                                            </li>--}}

                                        </ul>
                                    </nav>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-5 col-sm-10 col-xs-8 header-policy">
                                <form id="wpbSearchbox" class="formSearch" action="#" method="get">
                                    <input type="hidden" name="type" value="product">
                                    <input class="wpbSearch form-control" type="search" name="q" value="" placeholder="Search..." autocomplete="off" />
                                    <button id="wpbSearchButton" class="btnWpbingoSearch" type="submit" >
                                        <i class="ion ion-ios-search-strong"></i>
                                        <span class="btnSearchText"></span>
                                    </button>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>
        <a class="searchClose collapsed" href="#wpbSearchTop" data-toggle="collapse"><i class="ion ion-android-close"></i></a>
        <div id="wpbSearchTop" class="collapse">
            <div class="container text-center">
                <a class="btnClose" href="#wpbSearchTop" data-toggle="collapse"><i class="ion ion-android-close"></i></a>
                <h3 class="title">Search for products on our site</h3>
                <form id="wpbSearchbox" class="formSearch" action="https://wpbingo-fashow.myshopify.com/search" method="get">
                    <input type="hidden" name="type" value="product">
                    <input class="wpbSearch form-control" type="search" name="q" value="" placeholder="Search..." autocomplete="off" />
                    <button id="wpbSearchButton" class="btnWpbingoSearch" type="submit" >
                        <i class="ion ion-ios-search"></i>
                        <span class="btnSearchText">Search...</span>
                    </button>
                </form>
            </div>
        </div>

        <div id="wpbMenuMobile" class="menuMobileContainer hidden-md hidden-lg">
            <div class="memoHeader">
                <span>Mobile Menu</span>
                <div class="close btnMenuClose"><span>&times;</span></div>
            </div>
            <ul class="nav memoNav">
                <li class="active">
                    <a href="{{ url('/') }}" title="">Home</a>
                </li>
                <li>
                    <a href="{{ url('/shop') }}" title="">Shop</a>
                </li>
                <li>
                    <a href="{{ url('/blog') }}" title="">Blog</a>
                </li>
                {{-- <li>
                     <a href="modifier.php" title="">Modifier</a>
                 </li>
                 <li>
                     <a href="designer.php" title="">Designer</a>
                 </li>--}}
            </ul>
        </div>
        <div class="menuMobileOverlay hidden-md hidden-lg"></div>

    </div>
</div>
    @yield('content')



<div id="shopify-section-1537431725440" class="shopify-section wpbFramework">
    <div class="wpbBlockNewsletter" style="background-color: #f5f5f5;padding:100px 0; ">
        <div class="container">
            <div class="wpbBlock">
                <div class="row">
                    <div class="newsletter">
                        <div class="title-newsletter col-lg-4 col-md-4 col-sm-12 col-xs-12">

                            <h3 class="wpbTitle">OUR NEWSLETTER</h3>


                            <div class="newsletterDescription"><span>Sale up to 20%</span> off for your next purchase in this month!</div>

                        </div>
                        <div class="wpbContent col-lg-8 col-md-8 col-sm-12 col-xs-12">


                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" class="formNewsletter clearfix">
                                <div class="form-group">
                                    <input type="email" value="" placeholder="Enter your email..." name="EMAIL" id="mail" class="form-control" aria-label="Enter your email..." autocorrect="off" autocapitalize="off">
                                    <button id="subscribe" class="btn btnNewsletter" type="submit">
                                        <span>Subscribe</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="newsletterSocial col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="wpbSocial">
                            <ul class="wpblistSocial list-unstyled list-inline clearfix">

                                <li>
                                    <a target="_blank" href="#" title="Sheli Ghor on Facebook" class="btn-social btn-social-facebook" data-original-title="Facebook">
                                        <span class="fa fa-facebook"></span>
                                    </a>
                                </li>


                                <li>
                                    <a target="_blank" href="#" title="Sheli Ghor on Skyper" class="btn-social btn-social-skyper" data-original-title="Skyper">
                                        <span class="fa fa-skype"></span>
                                    </a>
                                </li>


                                <li>
                                    <a target="_blank" href="#" title="Sheli Ghor on Pinterest" class="btn-social btn-social-pinterest" data-original-title="Pinterest">
                                        <span class="fa fa-pinterest"></span>
                                    </a>
                                </li>



                                <li>
                                    <a target="_blank" href="https://twitter.com/Wpbingo" title="Sheli Ghor on Twitter" class="btn-social btn-social-twitter" data-original-title="Twitter">
                                        <span class="fa fa-twitter"></span>
                                    </a>
                                </li>


                                <li>
                                    <a target="_blank" href="#" title="Sheli Ghor on Instagram" class="btn-social btn-social-instagram" data-original-title="Instagram">
                                        <span class="fa fa-instagram"></span>
                                    </a>
                                </li>



                            </ul>
                        </div>

                    </div>


                    <div class="imgPayment col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <img class="img-payment" alt="Sheli Ghor" src="{{asset('front')}}/img/paymente747.png?v=1535707343" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="shopify-section-wpb-footer" class="shopify-section">
    <footer id="footer" style="background-color: #f5f5f5;">
        <div class="footerCenter">
            <div class="container">
                <div class="row">
                    <div class="footercontacInfo col-xs-12 col-sm-3 col-md-3 col-lg-3">

                        <div class="contactinfoFooter"><div class="wpb-contactinfo wpbBlock">
                                <h3 class="wpbcontactTitle">CONTACT US</h3>
                                <div class="wpb-content">


                                    <div class="contactinfo-address clearfix">Dhaka, Bangladesh</div>


                                    <div class="contactinfo-phone clearfix">0123456789</div>



                                    <div class="contactinfo-email clearfix">support@domain.com</div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="footerCenterMenu col-xs-12 col-sm-6 col-md-6 col-lg-6">

                        <div class="footerMenu col-xs-12 col-sm-6 col-md-6"><div class="wpbFooter">

                                <h3 class="wpbFooterTitle">Infomation</h3>

                                <div class="wpbContent">
                                    <ul class="wpbFooterLinks list-unstyled">

                                        <li class="">
                                            <a href="about-us.php" title="">About Us</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Shipping & Delivery</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Returns & Exchanges</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Terms & conditions</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="footerMenu col-xs-12 col-sm-6 col-md-6"><div class="wpbFooter">

                                <h3 class="wpbFooterTitle">Useful links</h3>

                                <div class="wpbContent">
                                    <ul class="wpbFooterLinks list-unstyled">

                                        <li class="">
                                            <a href="#" title="">Our Stores</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Cusstomer Services</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Featured Sale</a>
                                        </li>

                                        <li class="">
                                            <a href="#" title="">Promotion</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="footerTimeopen col-xs-12 col-sm-3 col-md-3 col-lg-3">


                        <h3 class="wpbTitleOpen">Opening time</h3>

                        <div class="openTime">

                            <p class="timeopen">
                                Monday - Friday

                                <span class="pull-right">
                          08:00 - 20:00
                        </span>

                            </p>


                            <p class="timeopen">
                                Saturday

                                <span class="pull-right">
                          09:00 - 21:00
                        </span>

                            </p>


                            <p class="timeopen">
                                Sunday

                                <span class="pull-right">
                          13:00 - 22:00
                        </span>

                            </p>


                            <p class="descopen">
                                We Work All The Holidays
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="footerCopyRight">
            <div class="container">
                <div class="row">
                    <div class="wpbCopyRight col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="clearfix">Copyright © 2018 <span>Own-Choice</span>. All Rights Reserved</div>
                    </div>
                    <div class="wpblinkCopyRight col-xs-12 col-sm-12 col-md-6 col-lg-6">

                        <div class="wpbContent">
                            <ul class="wpbFooterLinks list-unstyled">

                                <li class="">
                                    <a href="about-us.php" title="">About</a>
                                </li>

                                <li class="">
                                    <a href="contact-us.php" title="">Contact</a>
                                </li>

                                <li class="">
                                    <a href="cart.php" title="">Checkout</a>
                                </li>

                                <li class="">
                                    <a href="wishlist.php" title="">Wishlist</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </footer>
</div>

{{--<script id="CartTemplate" type="text/template">--}}

{{--<form action="/cart" method="post" novalidate class="cart ajaxcart">--}}
{{--<div class="ajaxcartInner">--}}

{{--<div class="ajaxcartHeader hidden-xs">--}}
{{--<div class="row rowAjaxCart">--}}
{{--<div class="text-center col-xs-12 col-sm-2 col-md-2">--}}
{{--<span>Image</span>--}}
{{--</div>--}}
{{--<div class="col-xs-12 col-sm-4 col-md-5">--}}
{{--<span>Product</span>--}}
{{--</div>--}}
{{--<div class="text-center col-xs-12 col-sm-4 col-md-3">--}}
{{--<span>Quantity</span>--}}
{{--</div>--}}
{{--<div class="text-right col-xs-12 col-sm-1 col-md-1">--}}
{{--<span>Price</span>--}}
{{--</div>--}}
{{--<div class="text-right col-xs-12 col-sm-1 col-md-1">--}}
{{--<span>&nbsp;</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--{{#items}}--}}
{{--<div class="ajaxcartProduct">--}}
{{--<div class="ajaxcartRow" data-line="{{line}}">--}}
{{--<div class="row rowAjaxCart">--}}
{{--<div class="drawerImage col-xs-12 col-sm-2 col-md-2">--}}
{{--<a href="{{url}}" class="ajaxcartProductImage"><img class="img-responsive" src="{{img}}" alt="" /></a>--}}
{{--</div>--}}
{{--<div class="drawerProRight col-xs-12 col-sm-4 col-md-5">--}}
{{--<div class="ajaxProductInfo">--}}
{{--<a href="{{url}}" class="ajaxcartProductName">{{name}}</a>--}}
{{--{{#if variation}}--}}
{{--<span class="ajaxcartProductMeta">{{variation}}</span>--}}
{{--{{/if}}--}}
{{--{{#properties}}--}}
{{--{{#each this}}--}}
{{--{{#if this}}--}}
{{--<span class="ajaxcartProductMeta">{{@key}}: {{this}}</span>--}}
{{--{{/if}}--}}
{{--{{/each}}--}}
{{--{{/properties}}--}}



{{--</div>--}}
{{--</div>--}}
{{--<div class="drawerProRight col-xs-12 col-sm-4 col-md-3">--}}
{{--<div class="ajaxcartQty">--}}
{{--<button type="button" class="qtyAdjust qtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}" data-line="{{line}}">--}}
{{--<span class="txtFallback">&minus;</span>--}}
{{--</button>--}}
{{--<input type="text" name="updates[]" class="qtyNum" value="{{itemQty}}" min="0" data-id="{{id}}" data-line="{{line}}"  pattern="[0-9]*" />--}}
{{--<button type="button" class="qtyAdjust qtyPlus" data-id="{{id}}" data-line="{{line}}" data-qty="{{itemAdd}}">--}}
{{--<span class="txtFallback">+</span>--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="drawerProRight col-xs-12 col-sm-1 col-md-1">--}}
{{--<div class="priceProduct textRight">--}}
{{--{{{price}}}--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="drawerProRight col-xs-12 col-sm-1 col-md-1">--}}
{{--<div class="text-center">--}}
{{--<a href="#" class="cartRemove" onclick="return false;" data-line="{{ line }}">--}}
{{--<i class="fa fa-trash"></i>--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--{{/items}}--}}
{{--<div class="ajaxCartFooter row noGutter">--}}



{{--<div class="drawerAjaxFooter col-xs-12 col-sm-6">--}}
{{--<div class="ajaxNote">--}}
{{--<label for="CartSpecialInstructions">Special instructions for seller</label>--}}
{{--<textarea name="note" class="form-control" id="CartSpecialInstructions">{{ note }}</textarea>--}}
{{--</div>--}}
{{--</div>--}}




{{--<div class="drawerAjaxFooter col-xs-12 col-sm-6">--}}
{{--<div class="ajaxSubTotal text-right">--}}
{{--<span>Subtotal</span>--}}
{{--<span class="h3 cartSubtotal priceProduct">{{{totalPrice}}}</span>--}}
{{--</div>--}}
{{--<p class="text-right">Shipping &amp; taxes calculated at checkout</p>--}}
{{--<div class="ajaxButton text-right">--}}
{{--<a class="btn btnWpbingoOne" href="/cart">View Cart</a>--}}
{{--<button type="submit" class="btn btnWpbingoTwo" name="checkout">--}}
{{--Check Out--}}
{{--</button>--}}
{{--</div>--}}



{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}

{{--</script>--}}
{{--<script id="wpbAjaxQty" type="text/template">--}}

{{--<div class="ajaxcartQty">--}}
{{--<button type="button" class="qtyAdjust qtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}">--}}
{{--<span class="txtFallback">&minus;</span>--}}
{{--</button>--}}
{{--<input type="text" class="qtyNum" value="{{itemQty}}" min="0" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*">--}}
{{--<button type="button" class="qtyAdjust qtyPlus" data-id="{{id}}" data-qty="{{itemAdd}}">--}}
{{--<span class="txtFallback">+</span>--}}
{{--</button>--}}
{{--</div>--}}

{{--</script>--}}
{{--<script id="wpbJsQty" type="text/template">--}}

{{--<div class="wpbJsQty">--}}
{{--<button type="button" class="wpbQtyAdjust wpbQtyAdjustMinus" data-id="{{id}}" data-qty="{{itemMinus}}">--}}
{{--<span class="txtFallback">&minus;</span>--}}
{{--</button>--}}
{{--<input type="text" class="wpbQtyNum" value="{{itemQty}}" min="1" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*" name="{{inputName}}" id="{{inputId}}" />--}}
{{--<button type="button" class="wpbQtyAdjust wpbQtyAdjustPlus" data-id="{{id}}" data-qty="{{itemAdd}}">--}}
{{--<span class="txtFallback">+</span>--}}
{{--</button>--}}
{{--</div>--}}

{{--</script>--}}
<div id="loading" style="display:none;"></div>
<div id="newsletterAlert" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="alert alert-success">
                <div class="newsletterAlert">Thank you for your subscription</div>
            </div>
        </div>
    </div>
</div>



<div id="wpbQuickView" style="display:none;">
    <div class="quickviewOverlay"></div>
    <div class="jsQuickview"></div>
    <div id="quickviewModal" class="quickviewProduct" style="display:none;">
        <a title="Close" class="quickviewClose fancybox-close" href="javascript:void(0);"></a>
        <div class="proBoxPrimary row">
            <div class="proBoxImage col-xs-12 col-sm-12 col-md-5">
                <div class="proFeaturedImage">
                    <a class="proImage" title="" href="#">
                        <img class="img-responsive proImageQuickview" src="{{ asset('front') }}/css/assets/loadingd92a.gif?4767156002400401035" alt="Quickview"  />
                        <span class="loadingImage"></span>
                    </a>
                </div>
                <div class="proThumbnails proThumbnailsQuickview clearfix">
                    <div class="owl-thumblist">
                        <div class="owl-carousel">

                        </div>
                    </div>
                </div>
            </div>
            <div class="proBoxInfo col-xs-12 col-sm-12 col-md-7">
                <h3 class="quickviewName"></h3>
                <div class="quickviewAvailability proAttr"></div>
                <h5 class="quickViewVendor proAttr"></h5>
                <div class="proShortDescription rte"></div>
                <form action="https://wpbingo-fashow.myshopify.com/cart/add" method="post" enctype="multipart/form-data" class="formQuickview form-ajaxtocart">
                    <div class="proPrice clearfix">
                        <span class="priceProduct pricePrimary"></span>
                        <span class="priceProduct priceCompare"></span>
                    </div>
                    <div class="proVariantsQuickview"><select name='id' style="display:none"></select></div>
                    <div class="proQuantity">
                        <input type="number" id="Quantity" name="quantity" value="1" min="1" class="qtySelector">
                    </div>
                    <div class="proButton">
                        <button type="submit" name="add" class="btn btnAddToCart">
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </form>



                <div class="btnWishlist">

                    <a class="btnProduct btnProductWishlist" href="login.php"><span>Add To Wishlist</span></a>

                </div></div>
        </div>
    </div>
</div>


<div id="goToTop" class="hidden-xs hidden-sm"><span class="fa fa-angle-double-up"></span></div>



<!-- <div id="wpbNewsletterModal" class="hidden">
   <div class="newsletterModal">
       <div class="wpbBlock wpbNewsletterModal">
           <h3 class="wpbTitle">NEWSLETTER</h3>
           <div class="wpbContent">

                   <div class="newsletterDescription">Subscribe to the Universal malling lisst to receive updates on new arrivals, offers and other disscount infomation.</div>


                   <form method="post" action="https://wpbingo-fashow.myshopify.com/contact#contact_form" id="contact_form" accept-charset="UTF-8" class="contact-form"><input type="hidden" name="form_type" value="customer" /><input type="hidden" name="utf8" value="✓" />
                       <div class="form-group">
                           <input class="form-control" id="newsletter-input" type="email" name="contact[email]" placeholder="Enter your email...">
                           <button class="btn btnNewsletter" type="submit">
                     <i class="zmdi zmdi-arrow-right"></i>
                               <span>Subscribe</span>
                           </button>
                           <input type="hidden" name="action" value="0">
                       </div>
                   </form>

           </div>
       </div>
   </div>
         </div> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('front') }}/js/api.jquery-0ea851da22ae87c0290f4eeb24bc8b513ca182f3eb721d147c009ae0f5ce14f9.js" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.vendord92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/js/option_selection-ea4f4a242e299f2227b2b8038152223f741e90780c0c766883939e8902542bda.js" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.bootstrapd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.handlebarsd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.fastclickd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.fancyboxd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.scrolltod92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.historyd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.countdownd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.ion.rangesliderd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.masterd92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/js/currencies.js" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.cookied92a.js?4767156002400401035" type="text/javascript"></script>
<script src="{{ asset('front') }}/css/assets/jquery.wpbd92a.js?v=1.0" type="text/javascript"></script>
<script src="{{ asset('front') }}/js/custom.js" type="text/javascript"></script>



</body>

</html>