@extends('layouts.app')

@section('content')
        <!-- Page Title
============================================= -->
@include('layouts.pageTitleSection', array('sectionName'=>'Reset Password'))
        <!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix f-arial">

            <div class="accordion accordion-lg divcenter nobottommargin clearfix col-md-5">

                <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open"></i>Reset Password</div>
                <div class="acc_content clearfix">
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ url('/password/reset') }}"
                          method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
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

                        <div class="col_full {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="login-form-password" class="f-arial">Confirm Password:</label>
                            <input type="password" id="login-form-password" name="password_confirmation" value=""
                                   class="sm-form-control"/>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                            @endif
                        </div>

                        <div class="col_full nobottommargin">
                            <button type="submit" class="button button-rounded button-yellow button-small"
                                    id="login-form-submit" name="login-form-submit" value="login">Reset Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</section><!-- #content end -->
@endsection
