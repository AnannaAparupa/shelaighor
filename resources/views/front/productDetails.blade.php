@extends('front.include.master')
@section('content')

    @include('front.include.bannar', ['breadcrumb2'=>ucfirst($product->title)])

    <main class="mainContent">


        <section id="pageContent">
            <div id="shopify-section-wpb-product" class="shopify-section">

                @if(Session::get('Message'))
                <div class="col-md-12">
                    <p class="alert alert-dismissable alert-success">{{ Session::get('Message') }}</p>
                </div>
                @endif


                <div class="productBox" itemscope itemtype="http://schema.org/Product">
                    <div class="proBoxPrimary">
                        <div class="proBoxPrimaryInner">
                            <div class="container">
                                <div class="row proFlyBlock">

                                    <div class="proBoxImage col-xs-12 col-sm-12 col-md-6">

                                        <div class="proFeaturedImage col-xs-12 col-sm-10 col-md-10">

                                            <img id="ProductPhotoImg" class="imgFlyCart img-responsive" style="width: 100%; height: 450px" src="{{ Voyager::image($product->featured_image) }}" alt="{{ $product->title }}" data-zoom-image="{{ Voyager::image($product->featured_image) }}" />
                                        </div>


                                        <div id="productThumbs" class="right proThumbnails vertical col-xs-12 col-sm-2 col-md-2">
                                            <div class="wpb-thumblist">
                                                <div class="slick-carousel">
                                                    @php
                                                    $gallery_images = \json_decode($product->gallery_image);
                                                    @endphp
                                                    @foreach($gallery_images as $gallery_image)
                                                        @php
                                                        $rendom = App\lib\LiberyFunction::randonGenerate();
                                                    @endphp
                                                    <div class="thumbItem">
                                                        <a class="{{ $loop->first? 'active':'' }}" href="javascript:void(0)" data-imageid="{{ $rendom }}" data-image="{{ Voyager::image($gallery_image) }}?v={{$rendom}}" data-zoom-image="{{ Voyager::image($gallery_image) }}?v={{$rendom}}">
                                                            <img class="img-responsive" src="{{ Voyager::image($gallery_image) }}?v={{$rendom}}" alt="{{ $product->title }}">
                                                        </a>
                                                    </div>
                                                        @endforeach



                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="proBoxInfo col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <h1 itemprop="name">{{ $product->title }}</h1>
                                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                            <meta itemprop="priceCurrency" content="BDT">
                                            <form action="{{ url('/cart/add') }}" method="post" enctype="multipart/form-data" class="formAddToCart clearfix">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="product_name" value="{{ $product->title }}">
                                                <input type="hidden" name="product_price" value="{{ App\lib\LiberyFunction::discountPrice($product->price, $product->discount) }}">
                                                <input type="hidden" name="image" value="{{ $product->featured_image }}">
                                                <div class="proPrice clearfix">
                                    <span id="ProductPrice" class="priceProduct" itemprop="price">
                                        {{ setting('site.currency') }} {{ App\lib\LiberyFunction::discountPrice($product->price, $product->discount) }}
                                    </span>

                                                </div>
                                                <div class="proReviews">
                                                    <span class="shopify-product-reviews-badge" data-id="1881963462714"></span>
                                                </div>


                                                <div class="proShortDescription rte" itemprop="description">
                                                    {{ $product->details }}
                                                </div>


                                                <div class="boxButton">
                                                    <div class="proQuantity">
                                                        <input type="number" id="Quantity" name="qty" value="1" min="1" class="qtySelector">
                                                    </div>
                                                    <div class="proButton">
                                                        <button type="submit" class="btn btnAddToCart">
                                                            <span class="icon ion-bag add_to_cart"></span>
                                                            <span id="AddToCartText">Add to Cart</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="proVariants clearfix">
                                                    <select name="color" required class="form-control">
                                                        @foreach($product->colors as $color)
                                                        <option  value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                            @endforeach

                                                    </select>

                                                </div>
                                                <br>
                                                <div class="proVariants clearfix">
                                                    <select name="size" required class="form-control">
                                                        @foreach($product->sizes as $size)
                                                        <option  selected="selected" value="{{ $size->id }}">{{ $size->size_name }}</option>
                                                            @endforeach
                                                    </select>

                                                </div>
                                            </form>
                                            <div class="clearfix wpbGroup">
                                                <link itemprop="availability" href="https://schema.org/InStock">


                                                <p class="proAttr productAvailability instock"><label>Availability:</label>{{ $product->stock > 0 ?"Many In Stock":"Not Available" }}</p>



                                                <p class="proAttr productVendor"><label>Vendor:</label> {{ $product->user->shop_name }}</p>



                                                <p class="proAttr productTags"><label>Tags:</label>
                                                    @foreach($product->tags as $tag)
                                                    <a href="#" title="{{ $tag->tag_title }}"> {{ $tag->tag_title }} {{ !$loop->last?",":'' }}</a>
                                                        @endforeach
                                                </p>

                                            </div>


                                            {{--<div class="wpbProductSharing clearfix">
                                                <label class="clearfix">Share:</label>
                                                <ul class="socialSharing list-unstyled">

                                                    <li>
                                                        <a class="btnSharing btnTwitter" href="javascript:void(0);" data-social="twitter">
                                                            <i class="fa fa-twitter"></i><span>Tweet</span>
                                                        </a>
                                                    </li>


                                                    <li>
                                                        <a class="btnSharing btnFacebook" href="javascript:void(0);" data-social="facebook">
                                                            <i class="fa fa-facebook"></i><span>Facebook</span>
                                                        </a>
                                                    </li>


                                                    <li>
                                                        <a class="btnSharing btnGooglePlus" href="javascript:void(0);" data-social="google-plus">
                                                            <i class="fa fa-google-plus"></i><span>Google+</span>
                                                        </a>
                                                    </li>



                                                    <li>
                                                        <a class="btnSharing btnPinterest" href="javascript:void(0);" data-social="pinterest">
                                                            <i class="fa fa-pinterest-p"></i><span>Pinterest</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>--}}



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="proDetailInfo">
                            <div class="container">
                                <div class="DetailsInfo">

                                    <ul class="nav nav-tabs">

                                        <li><a href="#proTabs1" data-toggle="tab" class="active">description</a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="proTabs1">
                                            {!! $product->description !!}
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </section>
                        <div class="container">






                            <section class="proRelated">
                                <div id="relatedProducts" class="wpbProducts">

                                    <h3 class="wpbTitle wpbHomeTitle clearfix">
		            <span class="groupTitle">



		                   <span class="title">RELATED PRODUCTS</span>

		            </span>
                                    </h3>

                                    <div class="wpbContent">
                                        <div class="wpbOwlRow owlCarouselPlay proList grid">
                                            <div class="owl-carousel"   data-nav="true"
                                                 data-autoplay="false"
                                                 data-autospeed="800"
                                                 data-speed="1000"
                                                 data-columnone=4
                                                 data-columntwo="3"
                                                 data-columnthree="2"
                                                 data-columnfour="2">

                                                @foreach($related_product as $related)
                                                <div class="item">





                                                    <div class="wpbProBlock proFlyBlock  multiple_image" data-price="{{ $related->price }}">
                                                        <div class="proHImage">
                                                            <a class="proFeaturedImage" href="{{ url('/product-details/'.$related->slug) }}">






                    <span>
                        <img class="img-responsive" alt="{{ $related->title }}" src="{{ Voyager::image($related->featured_image) }}">
                    </span>

                                                                <img class="img-responsive imgFlyCart image-primay" alt="{{ $related->title }}" src="{{ Voyager::image($related->featured_image) }}" />
                                                            </a>
                                                            @if($related->discount > 0)
                                                            <span class="labelSale">Sale</span>
                                                            @endif



                                                        </div>
                                                        <div class="proContent">
                                                            <h5 class="proName">
                                                                <a href="{{ url('/product-details/'.$related->slug) }}">{{ $related->title }}</a>
                                                            </h5>
                                                            <div class="proPrice">
                                                                <div class="priceProduct priceSale">{{ setting('site.currency') }} {{ App\lib\LiberyFunction::discountPrice($related->price, $related->discount) }}</div>
                                                                @if($related->discount > 0)
                                                                <div class="priceProduct priceCompare">{{ setting('site.currency') }}</div>
                                                                    @endif

                                                            </div>

                                                            <div class="proReviews">
                                                                <span class="shopify-product-reviews-badge" data-id="1881966051386"></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                    @endforeach




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>


                        </div>
                    </div>
                </div>

            </div>
        </section>


    </main>

    @endsection