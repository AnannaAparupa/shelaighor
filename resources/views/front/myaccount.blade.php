@extends('front.include.master')
@section('content')
    @include('front.include.bannar', ['breadcrumb2'=>'My account'])

    <main class="mainContent">
        <section id="pageContent">
            <div class="container">
                <div class="row">
                    <aside class="wpbSidebar col-xs-12 col-sm-12 col-md-3">
                        <div id="wpbCategories" class="wpbCategoriesSidebar blogSidebar">
                            <h4 class="titleSidebar">My Account</h4>

                            <div class="wpbContent">

                                <div class="itemCategory">
                                    <h5 class="cateTitle">
                                        <a class="cateItem " href="/blogs/clothes">Profile</a>
                                    </h5>
                                </div>

                                <div class="itemCategory">
                                    <h5 class="cateTitle">
                                        <a class="cateItem " href="/blogs/clothes">Order List</a>
                                    </h5>
                                </div>

                                <div class="itemCategory">
                                    <h5 class="cateTitle">
                                        <a class="cateItem " href="/blogs/clothes">Sign Out</a>
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </aside>
                    <div class="col-xs-12 col-sm-12 col-md-9">
                        <div class="blogContainer">
                            <table class="table table-striped">
                                <tr>
                                    <td>item 1</td>
                                    <td>item 2</td>
                                    <td>item 3</td>
                                    <td>item 4</td>
                                    <td>item 5</td>
                                </tr>
                                <tr>
                                    <td>item 1</td>
                                    <td>item 2</td>
                                    <td>item 3</td>
                                    <td>item 4</td>
                                    <td>item 5</td>
                                </tr>
                                <tr>
                                    <td>item 1</td>
                                    <td>item 2</td>
                                    <td>item 3</td>
                                    <td>item 4</td>
                                    <td>item 5</td>
                                </tr>
                                <tr>
                                    <td>item 1</td>
                                    <td>item 2</td>
                                    <td>item 3</td>
                                    <td>item 4</td>
                                    <td>item 5</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    @endsection