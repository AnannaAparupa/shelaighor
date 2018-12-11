@extends('front.include.master')
@section('content')

    @include('front.include.bannar', ['breadcrumb2'=>$blog_header])

    <main class="mainContent">

        <h1 class="wpbBlogTitle">Shorts</h1>

        <section id="pageContent">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-9">
                        <div class="blogContainer">



                            <div id="shopify-section-wpb-template-articles" class="shopify-section">




                                <div class="blogListArticle">

                                    <div class="wpbFlexRow flexRow">

                                        @forelse($blogs as $blog)
                                        <div class="owl-item blogArticle col-xs-12 col-sm-6 col-md-6 col-lg-4 wow fadeIn" data-wow-delay="120ms" >
                                            <div class="item">

                                                <div class="articleImage">
                                                    <a href="blog-details.php" title="{{$blog->blog_title}}">
                                                        <img class="img-responsive" src="{{ Voyager::image($blog->blog_image) }}" alt="{{$blog->blog_title}}" style="height: 180px; width: 100%"/>
                                                    </a>
                                                </div>

                                                <h4 class="articleTitile" style="min-height: 70px"><a href="{{ url('/blog-details/'.$blog->blog_slug) }}" title="{{$blog->blog_title}}">{{$blog->blog_title}}</a></h4>
                                                <div class="articleMeta">
                                                    <time class="articleMeta-date" datetime="{{ $blog->created_at }}"><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($blog->created_at)) }}</time>
                                                    <span class="articleMeta-author"><i class="fa fa-user"></i>{{ $blog->user->name }}</span><span class="articleCountComment"><i class="fa fa-comment"></i> 0</span>
                                                </div>
                                                <div class="articleContent">
                                                    <div class="rte">

                                                        <p>{{ str_limit($blog->blog_details, 89) }}</p>

                                                    </div>
                                                    <p class="btnReadmore"><a class="btnWpbingoReadmore btn" href="{{ url('/blog-details/'.$blog->blog_slug) }}">Continue reading</a></p>
                                                </div>
                                            </div>
                                        </div>

                                            @empty
                                            <p>Sorry, There is no Blogs</p>
                                    @endforelse
                                    </div>

                                    <div class="wpbPagination">
                                        <nav class="pull-right">
                                            {{ $blogs->links() }}
                                        </nav>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <aside class="wpbSidebar col-xs-12 col-sm-12 col-md-3">
                        <div id="shopify-section-blogsidebar" class="shopify-section">


                            <div id="wpbCategories" class="wpbCategoriesSidebar blogSidebar">
                                <h4 class="titleSidebar">Categories</h4>

                                <div class="wpbContent">

                                    @foreach($categories as $category)

                                    <div class="itemCategory">
                                        <h5 class="cateTitle">

                                            <a class="cateItem " href="{{ url('/blog?category='.$category->category_slug) }}">{{ $category->category_name }}</a>

                                        </h5>

                                    </div>
                                        @endforeach


                                </div>

                            </div>



                            <div class="blogSidebar">
                                <h4 class="titleSidebar">Recent Posts</h4>
                                <div class="wpbContent">
                                    <ul class="listSidebarBlog list-unstyled">

                                        @foreach($recent_posts as $recent_post)

                                        <li>
                                            <div class="articleImage"><img class="img-responsive" src="{{ Voyager::image($recent_post->blog_image) }}" alt="{{ $recent_post->blog_title }}" />
                                            </div>
                                            <div class="blogContent">
                                                <a href="{{ url('/blog-details/'.$recent_post->blog_slug) }}">{{ $recent_post->blog_title }}</a>
                                                <time datetime="2018-09-07">{{ date('M d, Y', strtotime($recent_post->created_at)) }}</time>
                                            </div>
                                        </li>
                                            @endforeach


                                    </ul>
                                </div>
                            </div>




                            <div class="blogSidebar">
                                <h4 class="titleSidebar">Tags</h4>
                                <div class="wpbContent">
                                    <ul class="blogTagsList list-inline">
                                        @foreach($tags as $tag)
                                        <li><a href="{{ url('/blog?tag='.$tag->tag_slug) }}" title="{{ $tag->tag_title }}">{{ $tag->tag_title }}</a></li>
                                            @endforeach


                                    </ul>
                                </div>
                            </div>



                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
    @endsection