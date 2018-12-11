<section id="wpbBreadcrumbs" style="background-image: url({{ asset('front') }}/img/breadcrumb0cae.jpg?v=1535507640)">
    <div class="container clearfix">
        <div class="row">
            <div class="breadcrumb-content">
                <div class="heading">
                    <h2 class="breadcrumb-heading">

                        {{  $breadcrumb2 }}

                    </h2>
                </div>
                <div class="content">
                    <nav>
                        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a href="{{ url('/') }}" title="Back to the frontpage" itemprop="item">
                                    <span itemprop="name">Home</span>
                                </a>
                                <meta itemprop="position" content="1" />
                            </li>


                            <li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <span itemprop="item"><span itemprop="name">{{ $breadcrumb2 }}</span></span>
                                <meta itemprop="position" content="2" />
                            </li>


                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>