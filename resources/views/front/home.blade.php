@extends('front.include.master')
@section('content')
    <main class="mainContent">
        @include('front.include.slider', ['sliders'=>$sliders])
        <div id="shopify-section-1537409613214" class="shopify-section wpbFramework">
            <div id="proList1537409613214" class="wpbProductsBanner" style="background-color: rgba(0,0,0,0); margin:70px 0 60px;">
                <div class="container">
                    <div class="wpbContent flexRow wpbFlexRow">
                        <div class="wpbProductsBannerImage col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <a href="#" title="Sheli Ghor">

                                <img class="img-responsive" alt="Sheli Ghor" src="{{ asset('front') }}/img/banner-home-9-1843d.png?v=1537410777" />

                            </a>
                        </div>
                        <div class="wpbProductsBannerContent col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <div class="contentTitle">

                                <h3 class="wpbTitle wpbHomeTitle">
                                    Featured product
                                </h3>

                            </div>
                            <div class="wpbOwlRow owlCarouselPlay proList grid">
                                <div class="owl-carousel"   data-nav="false"
                                     data-autoplay="false"
                                     data-autospeed="10000"
                                     data-speed="300"
                                     data-columnone="3"
                                     data-columntwo="3"
                                     data-columnthree="2"
                                     data-columnfour="2"
                                     data-columnfive="1">
                                    @foreach($featuredProducts->chunk(2) as $featuredProductsTwo)
                                    <div class="item">
                                        @foreach($featuredProductsTwo as $featureProduct)
                                        <div class="wpbProBlock proFlyBlock  multiple_image" data-price="{{ $featureProduct->price }}">
                                            <div class="proHImage">
                                                <a class="proFeaturedImage" href="{{ url('/product-details/'.$featureProduct->slug) }}">
                                                    <span>
                                                        <img class="img-responsive" alt="{{ $featureProduct->title }}" src="{{ Voyager::image($featureProduct->featured_image) }}">
                                                    </span>
                                                    @php
                                                    $gallery_image = json_decode($featureProduct->gallery_image);
                                                    @endphp
                                                    <img class="img-responsive imgFlyCart image-primay" alt="{{ $featureProduct->title }}" src="{{ Voyager::image($gallery_image[0]) }}" />
                                                </a>
                                                @if($featureProduct->discount > 0)
                                                <span class="labelSale">Sale</span>
                                                @endif
                                                @if($featureProduct->stock > 0)
                                                <p class="proAttr instock hidden ">Many In Stock</p>
                                                @endif

                                            </div>
                                            <div class="proContent">
                                                <h5 class="proName">
                                                    <a href="{{ url('/product-details/'.$featureProduct->slug) }}"> {{ $featureProduct->title }}</a>
                                                </h5>
                                                <div class="proPrice">
                                                    <div class="priceProduct priceSale">{{ setting('site.currency') }} {{ App\lib\LiberyFunction::discountPrice($featureProduct->price, $featureProduct->discount) }}</div>
                                                    @if($featureProduct->discount > 0)
                                                    <div class="priceProduct priceCompare">{{ setting('site.currency') }} {{ $featureProduct->price }}</div>
                                                        @endif

                                                </div>

                                                <div class="proReviews">
                                                    <span class="shopify-product-reviews-badge" data-id="1882011762746"></span>
                                                </div>

                                            </div>
                                        </div>
                                            @endforeach

                                    </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="shopify-section-1537415184394" class="shopify-section wpbFramework"><div class="wpbBanner" style="margin:0 0 100px 0;">
                <div class="container-full">
                    <div class="singleImage" style="background-image: url({{asset('front')}}/img/singleimg2af24.jpg?v=1537415222);">
                        <div class="contentImage">
                            <div class="infoImage">

                                <p class="subImage">SALE</p>


                                <h2 class="titleImage"><span>50%</span> OFF</h2>


                                <p class="descImage">Fashionable Balo and Accessories in the Summer</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="shopify-section-1537417120253" class="shopify-section wpbFramework">
            <div id="proList1537417120253" class="wpbProductsBanner wpbProductsBannerRight" style="background-color: rgba(0,0,0,0);margin:0 0 60px;">
                <div class="container">
                    <div class="wpbContent flexRow wpbFlexRow">
                        <div class="wpbProductsBannerContent col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <div class="contentTitle">

                                <h3 class="wpbTitle wpbHomeTitle">
                                    New arrivals
                                </h3>

                            </div>
                            <div class="wpbOwlRow owlCarouselPlay proList grid">
                                <div class="owl-carousel"   data-nav="false"
                                     data-autoplay="false"
                                     data-autospeed="10000"
                                     data-speed="300"
                                     data-columnone="3"
                                     data-columntwo="3"
                                     data-columnthree="2"
                                     data-columnfour="2"
                                     data-columnfive="1">

                                    @foreach($newArraivls->chunk(2) as $newArraivalsProducts)
                                    <div class="item">
                                        @foreach($newArraivalsProducts as $newArraivalsProduct)
                                        <div class="wpbProBlock proFlyBlock  multiple_image" data-price="{{ $newArraivalsProduct->price }}">
                                            <div class="proHImage">
                                                <a class="proFeaturedImage" href="{{ url('/product-details/'.$newArraivalsProduct->slug) }}">
                                                    <span>
                                                        <img class="img-responsive" alt="{{ $newArraivalsProduct->title }}" src="{{ Voyager::image($newArraivalsProduct->featured_image) }}">
                                                    </span>

                                                    @php
                                                    $newGalleryImage = json_decode($newArraivalsProduct->gallery_image)
                                                    @endphp
                                                    <img class="img-responsive imgFlyCart image-primay" alt="{{ $newArraivalsProduct->title }}" src="{{ Voyager::image($newGalleryImage[0]) }}" />
                                                </a>

                                            </div>
                                            <div class="proContent">
                                                <h5 class="proName">
                                                    <a href="{{ url('/product-details/'.$newArraivalsProduct->slug) }}">{{ $newArraivalsProduct->title }}</a>
                                                </h5>
                                                <div class="proPrice">
                                                    <div class="priceProduct ">{{ setting('site.currency') }}{{ $newArraivalsProduct->price }}</div>

                                                </div>

                                                <div class="proReviews">
                                                    <span class="shopify-product-reviews-badge" data-id="1881963462714"></span>
                                                </div>

                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="wpbProductsBannerImage col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <a href="#" title="Sheli Ghor">

                                <img class="img-responsive" alt="Sheli Ghor" src="{{ asset('front') }}/img/banner-home-9-2af2a.png?v=1537417195" />

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="shopify-section-1536833568159" class="shopify-section wpbFramework">
            <div id="wpbBlogCarousel" class="wpbBlog " style="background-color: rgba(0,0,0,0);margin:0 0 100px;">
                <div class="container">
                    <div class="titleBlog">

                        <div class="wpbHomeTitle">
                            Latest news
                        </div>

                    </div>
                    <div class="wpbContent">
                        <div class="owlCarouselPlay">
                            <div class="owl-carousel"   data-nav="false"
                                 data-autoplay="false"
                                 data-autospeed="10000"
                                 data-speed="300"
                                 data-columnone="4"
                                 data-columntwo="3"
                                 data-columnthree="2"
                                 data-columnfour="1">
                                @foreach($latestNews as $latestnews)
                                <div class="item blogArticle">

                                    <div class="articleImage">
                                        <img class="img-responsive" style="height: 180px; widows: 100%;" src="{{ Voyager::image($latestnews->blog_image) }}" alt="{{ $latestnews->blog_title }}" />
                                    </div>
                                    <div class="blogContent">
                                        <h4 class="articleTitile" style="min-height: 100px;"><a href="{{ url('/blog-details/'.$latestnews->blog_slug) }}" title="{{ $latestnews->blog_title }}">{{ $latestnews->blog_title }}</a></h4>
                                        <time class="articleMeta-date" datetime="{{ $latestnews->created_at }}"><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($latestnews->created_at)) }}</time>
                                        <span class="articleMeta-author"><i class="ion-compose"></i>{{ $latestnews->user->name }}</span>
                                        <div class="articleContent">
                                            <div class="rte">

                                                <p>{{ str_limit($latestnews->blog_details) }}</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="shopify-section-1537431120786" class="shopify-section wpbFramework">
            <div class="wpbBorder" style="margin:0 0 100px;">
                <div class="container">
                    <div class="borderStyle" style="border-top: solid 1px #ebebeb">&nbsp;</div>
                </div>
            </div>
        </div>
    </main>
    @endsection