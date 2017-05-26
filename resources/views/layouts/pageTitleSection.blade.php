<!-- Page Title
  ============================================= -->
<section id="page-title">
    <div class="container clearfix">
      {{--*/ $title = $sectionName /*--}}
      @if(strpos($sectionName, '/') !== false)
        {{--*/ $title = strstr($sectionName, '/') /*--}}
      @endif
   <h1>{{str_replace('/', '',$title)}}</h1>
   @if (isset($detail))
       <span>{{$detail}}</span>
   @endif
   <ol class="breadcrumb">
       <li><a href="/">Home</a></li>
       <li class="active">{{strtolower($sectionName)}}</li>
   </ol>
</div>
</section>
<!-- #page-title end -->