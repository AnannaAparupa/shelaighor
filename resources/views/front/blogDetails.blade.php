@extends('front.include.master')
@section('content')
    @include('front.include.bannar', ['breadcrumb2'=>$blog->blog_title])
    <main class="mainContent">


        <section id="pageContent">
            <div class="container clearfix">
                <div class="main-archive row">


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <article class="articleItem" itemscope itemtype="http://schema.org/Article">


                            <div class="articleImage">
                                <img class="img-responsive" src="{{ Voyager::image($blog->blog_image) }}" alt="{{ $blog->blog_title }}" />
                            </div>

                            <div class="row">
                                <div class="withoutContent col-lg-8 col-lg-offset-2">
                                    <header class="articleHeader">
                                        <h1 class="wpbArticleTitle">{{ $blog->title }}</h1>
                                        <div class="articleMeta">
                                            <time class="articleMeta-date" datetime="{{ $blog->created_at }}"><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($blog->created_at)) }}</time>
                                            <span class="articleMeta-author"><i class="fa fa-user"></i> {{ $blog->user->name }}</span><span class="articleCountComment"><i class="fa fa-comment"></i> 0</span>
                                        </div>
                                    </header>
                                    <div class="rte" itemprop="articleBody" style="text-align: justify">
                                     {!! $blog->blog_details !!}
                                    </div>


                                    <div class="article-meta">
                                        <div class="articleMeta-blog"><span>Posted In:</span> {{ $blog->category->category_name }}</div>

                                        <div class="articleTags">
                                            <span>Tagget:</span>
                                            @foreach($blog->tags as $tag)
                                            <a href="{{ url('/blog?tag='.$tag->tag_slug) }}">{{ $tag->tag_title }}</a>
                                                @if(!$loop->last)
                                                    ,
                                                    @endif
                                                @endforeach

                                        </div>


                                    </div>

                                   {{-- <div class="articleComment">
                                        <h3 class="wpbCommentTitle">0 comments</h3>
                                        <div class="wpbContent">

                                            <div id="comments">


                                                <div class="formComment">
                                                    <form method="post" action="/blogs/shorts/porttitor-lectus-sodales/comments#comment_form" id="comment_form" accept-charset="UTF-8" class="comment-form"><input type="hidden" name="form_type" value="new_comment" /><input type="hidden" name="utf8" value="✓" />
                                                        <h3 class="wpbCommentTitle">Leave a comment</h3>

                                                        <div class="row">
                                                            <div class="commentText col-xs-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="CommentBody" class="hidden">Message</label>
                                                                    <textarea name="comment[body]" id="CommentBody" class="form-control" rows="4" placeholder="Message"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="commentName col-xs-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="CommentAuthor" class="hidden">Your Name</label>
                                                                    <input type="text" name="comment[author]" id="CommentAuthor" class="form-control" placeholder="Your Name" value="" autocapitalize="words">
                                                                </div>
                                                            </div>
                                                            <div class="commentEmail col-xs-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="CommentEmail" class="hidden">Your Email</label>
                                                                    <input type="email" name="comment[email]" id="CommentEmail" class="form-control" placeholder="Your Email" value="" autocorrect="off" autocapitalize="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="commentWebsite col-xs-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="CommentWeb" class="hidden">Website</label>
                                                                    <input type="website" name="comment[website]" id="CommentWeb" class="form-control" placeholder="Website" value="" autocorrect="off" autocapitalize="off">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="submit" class="btn btnWpbingoOne btnComment" value="Post comment">
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>--}}

                                </div>
                            </div>
                        </article>
                    </div>

                </div>
            </div>
        </section>
    </main>
    @endsection