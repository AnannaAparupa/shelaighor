@extends('front.include.master')
@section('content')
    @include('front.include.bannar', ['breadcrumb2'=>$shopHeader])
    <main class="mainContent">

        <section id="pageContent">
            <div class="container">
                <div class="main-archive row">

                    <aside id="wpbSidebar" class="wpbSidebar col-xs-12 col-sm-12 col-md-3">
                        <div id="shopify-section-sidebartop" class="shopify-section">

                            <div id="wpbCategories" class="wpbCategoriesSidebar">
                                <h3 class="titleSidebar">CATEGORIES</h3>
                                <div class="wpbContent">

                                    @foreach($categories as $category)
                                    <div class="itemCategory">
                                        <h5 class="cateTitle">

                                            <a class="cateItem " href="{{ url('/shop?category='.$category->category_slug) }}">{{ $category->category_title }}</a>

                                        </h5>

                                    </div>
                                        @endforeach

                                </div>
                            </div>



                        </div>


                    </aside>

                    <div id="proListCollection" class="wpbCenterColumn col-xs-12 col-sm-12 col-md-9">
                        <div id="shopify-section-wpb-template-collections" class="shopify-section">



                            <div class="collBoxProducts">




                                <div id="wpbProList" class="proList grid">
                                    <div class="wpbFlexRow flexRow">
                                        @forelse($products as $product)
                                        <div class="wpbProBlock proFlyBlock col-xs-12 col-sm-6 col-md-4 col-lg-3 multiple_image" data-price="{{ $product->price }}">
                                            <div class="proHImage">
                                                <a class="proFeaturedImage" href="{{ url('/product-details/'.$product->slug) }}">

                    <span>
                        <img class="img-responsive" alt="{{ $product->title }}" src="{{ Voyager::image($product->featured_image) }}">
                    </span>

                                                    @php
                                                        $gallery_image = json_decode($product->gallery_image);
                                                    @endphp
                                                    <img class="img-responsive imgFlyCart image-primay" alt="{{ $product->title }}" src="{{ Voyager::image($gallery_image[0]) }}" />
                                                </a>
                                                @if($product->discount > 0)
                                                    <span class="labelSale">Sale</span>
                                                @endif


                                            </div>
                                            <div class="proContent">
                                                <h5 class="proName">
                                                    <a href="{{ url('/product-details/'.$product->slug) }}">{{ $product->title }}</a>
                                                </h5>
                                                <div class="proPrice">
                                                    <div class="priceProduct priceSale">{{ setting('site.currency') }} {{ App\lib\LiberyFunction::discountPrice($product->price, $product->discount) }}</div>
                                                    @if($product->discount > 0)
                                                        <div class="priceProduct priceCompare">{{ setting('site.currency') }} {{ $product->price }}</div>
                                                    @endif

                                                </div>

                                                <div class="proReviews">
                                                    <span class="shopify-product-reviews-badge" data-id="1881963462714"></span>
                                                </div>

                                            </div>
                                        </div>
                                        @empty
                                            <p>There is no product</p>
                                        @endforelse
                                    </div>
                                </div>


                            </div>

                            <div class="wpbPagination clearfix">

                                <nav class="pull-right">
                                    {{ $products->links() }}
                                </nav>






                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection