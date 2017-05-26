@extends('layouts.app')

@section('content')
        <!-- Page Title
============================================= -->
@include('layouts.pageTitleSection', array('sectionName'=>'Login'))
        <!-- Content
		============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix f-arial">

            <div class="accordion accordion-lg divcenter nobottommargin clearfix col-md-5">

                <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open"></i>Login To Your Account
                </div>
                <div class="acc_content clearfix">
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ url('/login') }}"
                          method="post">
                        {!! csrf_field() !!}
                        @if(Session::has('failure'))
                            <div></div>
                            <div class="alert alert-danger" id="errorMessage" style="display: block">
                                {{Session::get('failure')}}
                            </div>
                        @endif
                        @if(Session::has('status'))
                            <div></div>
                            <div class="alert alert-success" id="errorMessage" style="display: block">
                                {{Session::get('status')}}
                            </div>
                        @endif
                        <div class="col_full {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="login-form-username" class="f-arial">Email:</label>
                            <input type="text" id="login-form-username" name="email" value="" class="sm-form-control"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>

                        <div class="col_full {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="login-form-password" class="f-arial">Password:</label>
                            <input type="password" id="login-form-password" name="password" value=""
                                   class="sm-form-control"/>
                            @if ($errors->has('password'))
                                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                            @endif
                        </div>

                        <div class="col_full">
                            <div class="col-md-12-fluient">
                                <div class="checkbox">
                                    <label class="f-arial">
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col_full nobottommargin">
                            <button type="submit" class="btn btn-gold" id="login-form-submit" name="login-form-submit"
                                    value="login"> &nbsp; &nbsp; Login &nbsp; &nbsp; </button>
                            <a href="{{ url('/password/reset') }}" class="fright">Forgot Password?</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</section><!-- #content end -->
@endsection
