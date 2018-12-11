@extends('front.include.master')
@section('content')

    @include('front.include.bannar', ['breadcrumb2'=>'Login'])
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
                        <div class="col-xs-12 col-sm-6">
                            <div class="formAccount formLogin">
                                <div class="alert alert-success" id="ResetSuccess" style="display:none;">
                                    We&#39;ve sent you an email with a link to update your password.
                                </div>
                                <div id="CustomerLoginForm" class="formAccountLogin">
                                    <h1 class="wpbAccountTitle">Login</h1>
                                    <form method="post" action="{{ url('/login') }}" id="customer_login" accept-charset="UTF-8"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />
                                        <div class="formContent">
                                            @csrf


                                            <div class="form-group">
                                                <label for="CustomerEmail" class="">Email</label>
                                                <input type="email" name="email" id="CustomerEmail" class="form-control" placeholder="Email" autocorrect="off" autocapitalize="off" autofocus>
                                            </div>

                                            <div class="form-group">
                                                <label for="CustomerPassword" class="">Password</label>
                                                <input type="password" value="" name="password" id="CustomerPassword" class="form-control" placeholder="Password">
                                            </div>


                                            {{--<p class="forgetPassword"><a href="#recover" id="RecoverPassword">Forgot your password?</a></p>

                                            --}}<p><input type="submit" class="btn btnWpbingoOne" value="Sign In"></p>
                                            <p class="hidden"><a href="https://wpbingo-fashow.myshopify.com">Return to Store</a></p>
                                        </div>
                                    </form>
                                </div>
                               {{-- <div id="RecoverPasswordForm" class="formAccountRecover" style="display: none;">
                                    <h2 class="wpbAccountTitle">Reset your password</h2>
                                    <form method="post" action="/account/recover" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password" /><input type="hidden" name="utf8" value="✓" />
                                        <div class="formContent">
                                            <p>We will send you an email to reset your password.</p>


                                            <div class="form-group">
                                                <label for="RecoverEmail" class="">Email</label>
                                                <input type="email" value="" name="email" id="RecoverEmail" class="form-control" placeholder="Email" autocorrect="off" autocapitalize="off">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btnWpbingoOne" value="Submit">
                                                <button type="button" id="HideRecoverPasswordLink" class="btn btnWpbingoCancel">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>--}}

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="formAccount formLogin">
                                <h3 class="wpbAccountTitle">Create Account</h3>
                                <div class="formContent">
                                    <div class="registerDescription">
                                        <p>Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                                    </div>
                                    <div class="submit">
                                        <a class="btn btnWpbingoOne" href="{{ url('/register') }}">
                                            <span>Create an account</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection