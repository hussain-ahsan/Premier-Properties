<!-- Header
  ============================================= -->
<header id="header" class="full-header">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
              ============================================= -->

            <div id="logo">
                <a href="/" class="standard-logo" data-dark-logo={{asset("images/logo-dark.png")}}>
                    <img src="{{asset("images/premier-properties-logo.png")}}" alt="PremierPropertiesLogo">
                </a>
                <a href="/" class="retina-logo" data-dark-logo={{asset("images/logo-dark@2x.png")}}>
                    <img src="{{asset("images/premier-properties-logo.png")}}" alt="PremierPropertiesLogo">
                </a>
            </div>
            <!-- #logo end -->

            <!-- Primary Navigation
              ============================================= -->
            {{--*/
              $accountURL = url('/logout');
              $title = "Logout";
              $menuClass = "p-8-menu";
            /*--}}
            @if (Auth::guest())
                {{--*/
                $accountURL = url('/login');
                $title = "Login";
                $menuClass = "";
                /*--}}
            @endif
            <nav id="primary-menu" class="{{$menuClass}}">
                <ul>
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="{{ url('/about-us') }}">Company</a></li>
                    <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ url('/case-studies') }}">Case Studies</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    @if (!Auth::guest())
                        @if(\Auth::user() -> hasPermission(env('permission_for_properties')))
                            <li><a href="{{ url('/properties') }}">Properties</a></li>
                        @endif
                        @if(\Auth::user() -> hasPermission(env('permission_for_company')))
                            <li><a href="{{ url('/companies') }}">Companies</a></li>
                        @endif
                        @if(\Auth::user() -> hasPermission(env('permission_for_users')))
                            <li><a href="{{ url('/users') }}">Users</a></li>
                        @endif
                    @endif


                    <li><a href="{{$accountURL}}" title="{{$title}}"><i class="icon-user"></i></a></li>

                </ul>
            </nav>
            <!-- #primary-menu end -->

        </div>
    </div>
</header>
<!-- #header end -->