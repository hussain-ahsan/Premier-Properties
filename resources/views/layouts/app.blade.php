<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}">
    {{--*/ $page =  Request::path() == '/' ? 'Home' : ucwords(str_replace('-', ' ', Request::path()))  /*--}}

    <title>{{env('project_name')}} - {{$page}}</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet'
          type='text/css'>

    <!-- Library -->
    <script src="{{asset('/assets/js/library/moment-with-locales.js')}}"></script>
    <script src="{{asset('assets/js/library/async.js')}}"></script>

    <!-- CSS(all.css) and LESS(app.css) -->
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/all.css')}}">

    <script>
        window.basePath = '{{base_path()}}';
        window.dateTimePickerFormat = '{{env('DATE_TIME_PICKERS_FORMAT')}}';
        window.dateTimePickerYearFormat = '{{env('DATE_TIME_PICKERS_YEAR_FORMAT')}}';
    </script>
</head>
<body id="app-layout" class="stretched no-transition">
<script type="text/javascript" src={{asset("assets/js/library/jquery.js")}}></script>
<script type="text/javascript" src={{asset("assets/js/library/bootstrap-datetimepicker.js")}}></script>

<div id="wrapper" class="clearfix">
    @include('layouts.header')
    @yield('content')
    @include(('layouts.footer'))
</div>

<script type="text/javascript" src={{asset("assets/js/library/plugins.js")}}></script>
<script type="text/javascript" src="{{asset('assets/js/library/bs-datatable.js')}}"></script>
<script type="text/javascript" src={{asset("assets/js/library/functions.js")}}></script>
<script type="text/javascript" src={{asset("assets/js/library/components/datepicker.js")}}></script>
<script type="text/javascript" src={{asset("assets/js/library/components/timepicker.js")}}></script>
<script type="text/javascript" src={{asset("assets/js/library/components/daterangepicker.js")}}></script>

</body>
</html>
