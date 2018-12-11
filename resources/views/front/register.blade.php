@extends('front.include.master')
@section('content')
    @include('front.include.bannar', ['breadcrumb2'=>'Register'])


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
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                            <div class="formAccount">
                                <h1 class="wpbAccountTitle">Create Account</h1>
                                <form method="post" action="{{ url('/register') }}" id="create_customer" accept-charset="UTF-8"><input type="hidden" name="form_type" value="create_customer" /><input type="hidden" name="utf8" value="✓" />
                                    @csrf
                                    <div class="formContent">

                                        <div class="form-group">
                                            <label for="FirstName" class="">Name</label>
                                            <input type="text" name="name" id="FirstName" class="form-control" placeholder="First Name"  autocapitalize="words" autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="Email" class="">Email</label>
                                            <input type="email" name="email" id="Email" class="form-control" placeholder="Email"  autocorrect="off" autocapitalize="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="phone"  autocorrect="off" autocapitalize="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="CreatePassword" class="">Password</label>
                                            <input type="password" name="password" id="CreatePassword" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="CreatePassword2" class="">Password Confirmation</label>
                                            <input type="password" name="password_confirmation" id="CreatePassword2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Create an account" class="btn btnWpbingoOne">
                                        </div>
                                        <p><a class="wpbLinkCancel" href="{{ url('/shop') }}">Return to Store</a></p>
                                        <p><a class="wpbLinkCancel" href="{{ url('/login') }}">Return to Login</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection