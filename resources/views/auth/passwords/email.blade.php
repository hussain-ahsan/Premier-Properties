@extends('layouts.app')

        <!-- Main Content -->
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

                <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open"></i>Reset Your Password
                </div>
                <div class="acc_content clearfix">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ url('/password/email') }}"
                          method="post">
                        {!! csrf_field() !!}
                        <div class="col_full {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="login-form-username" class="f-arial">Email:</label>
                            <input type="text" id="login-form-username" name="email" value="" class="sm-form-control"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>

                        <div class="col_full nobottommargin">
                            <button type="submit" class="button button-rounded button-yellow button-small"
                                    id="login-form-submit" name="login-form-submit" value="">Reset Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</section><!-- #content end -->
@endsection
