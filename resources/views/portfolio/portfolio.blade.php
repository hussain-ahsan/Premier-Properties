@extends('layouts.app')
@section('content')

        <!--about us section start-->
<section class="row static-feature m-0">
    <div class="container">
        <h1>Portfolio</h1>
        <p>SOME OF OUR SUCCESS.</p>
    </div>
</section>
<!--about us section end-->
<!-- Content
============================================= -->
<section id="content">
    <section class="content-wrap portfolio-cnt">
        <section data-animate="fadeIn" data-delay="400" class="fadeIn animated">
            <div class="container">
                <div class="row">
                    @foreach($allProperties as $property)

                        <div class="col-md-4 col-sm-6 col-xs-12 text-center portf-content">
                            <img width="280" height="343" src="{{(env('PROPERTY_IMAGE_PATH').$property->id.'/'. env('PORTFOLIO_WIDTH').'*'.env('PORTFOLIO_HEIGHT').'_'. $property->image )}}" onerror="this.src='/images/noImg.jpg'" alt="Portfolio Image {{$property->id}}">

                            {{--*/ $propertyName = $property -> name != '' ? $property -> name : ''  /*--}}
                            {{--*/ $propertyCity =  $property -> city != '' ? $property -> city . ',' : ''   /*--}}
                            {{--*/ $propertyState =  $property -> state != '' ? $property -> state : ''   /*--}}
                            @if ($propertyState != '')
                            @foreach($states as $state)
                            @if($state ->state_code == $propertyState)
                            {{--*/ $propertyState = $state ->state_name /*--}}
                            @endif
                            @endforeach
                            @endif

                                    <!--Hover content start-->
                            <div class="hover-portf-content">
                                @if($property -> property_investment_status == env('2_PROPERTY_STATUS'))
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf1.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>ROI</p>
                                            <h4>{{$property -> roi ? $property -> roi.'%' : 'N/A'}}</h4></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf2.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Holding Period</p>
                                            <h4>{{$property -> holding_period ? $property -> holding_period : 'N/A'}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf3.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Purchase Price</p>
                                            <h4>{{$property -> purchased_price ? '$'.$property -> purchased_price : 'N/A'}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf4.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Sale Price</p>
                                            <h4>{{$property -> sale_price ? '$'.$property -> sale_price : 'N/A'}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf5.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Sq Footage</p>
                                            <h4>{{$property -> lot_area ? $property -> lot_area : 'N/A'}}</h4></div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf6.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Purchase Price</p>
                                            <h4>{{$property -> purchased_price ? '$'. $property -> purchased_price  : 'N/A'}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf5.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Sq. Footage of building</p>
                                            <h4>{{$property -> lot_area ? $property -> lot_area : 'N/A'}}</h4></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><img src="images/portfolio/icon-pf4.jpg" alt="portfolio icon"></div>
                                        <div class="col-xs-8"><p>Debt on property</p>
                                            <h4>{{$property -> original_debt ? '$'.$property -> original_debt :  'N/A'}}</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--Hover content end-->
                            <div class="portfolio-desc text-left">
                                <h3><a>{{$propertyName}}</a></h3>
                                <span>{{$propertyCity}} {{$propertyState}}</span>
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>
        </section>
    </section>
</section>
@endsection
