@extends('layouts.app')
@section('content')
    @include('layouts.pageTitleSection', array('sectionName'=>'Properties'))
    @include('properties.modal')
    @include('properties.associateCompanyModal')
    @include('properties.yearTaxModal')
    <link rel="stylesheet" href="{{asset('assets/css/custom/properties.css')}}">
    <script src="{{asset('assets/js/custom/general.js')}}"></script>
    <script src="{{asset('assets/js/custom/properties.js')}}"></script>
    <script>
        window.imagePath = '{{env('PROPERTY_IMAGE_PATH')}}';
        window.reportPath = '{{env('USER_REPORT_UPLOAD_PATH')}}';
        var company =  <?php echo json_encode($companies);?>;
        window.companies = company;
    </script>
    @if(count($properties) == 0)
        <div class="row">
            <div class="col-md-12 text-center">
                <span>No Property found</span>
            </div>
        </div>
    @endif

    <section id="content">
        <div class="content-wrap properties-pg">
            <div class="container clearfix">
                <div class="row row m-0">
                    @if (Auth::User() -> hasRole(env('ADMIN_ROLE')))
                        <span class="pull-right btns-year-add">
                  <button type="button" class="btn btn-gold f-arial pull-right" onclick="addEditProperty()">ADD/EDIT
                      PROPERTY
                  </button>
              </span>
                    @endif
                    <span class="pull-right btns-year-add">
              <button type="button" class="btn btn-gold f-arial pull-right" onclick="taxInformation()">YEAR END TAX
                  INFORMATION
              </button>
            </span>
                </div>

                {{--loop--}}
                @foreach($properties as $prop)
                    <div class="property-list cursor_p" property-id="{{$prop -> id}}">

                        @if($prop -> image != '')
                            {{--*/ $img =(env('PROPERTY_IMAGE_PATH').$prop->id.'/'.env('LISTING_WIDTH').'*'.env('LISTING_HEIGHT').'_'. $prop -> image)  /*--}}
                        @else
                            {{--*/ $img = env('PROPERTY_IMAGE_PATH') . 'noImg.jpg' /*--}}
                        @endif
                        {{--*/ $state = $prop->state ? $prop->state : ''; /*--}}
                        {{--*/ $city = $prop->city ? $prop->city . ',' : ''; /*--}}
                        {{--*/ $address = $prop->street_address ? $prop->street_address  : ''; /*--}}
                        {{--*/ $date = $prop->date_purchase && strtotime($prop->date_purchase) > 0 ? date('m/d/y', strtotime($prop->date_purchase)) : 'N/A' /*--}}
                        {{--*/ $lender = $prop->lender ? $prop->lender . '' : 'N/A'; /*--}}
                        {{--*/ $purchaseBook = $prop->purchased_price ? '$'.$prop->purchased_price . '' : 'N/A'; /*--}}
                        {{--*/ $blockLot = $prop->block_lot ? $prop->block_lot : 'N/A' /*--}}
                        {{--*/ $buildingType = $prop->building_type ? $prop->building_type . '' : 'N/A'; /*--}}
                        {{--*/ $market = $prop->market ? $prop->market . '' : 'N/A'; /*--}}

                        {{--*/ $color = "status_green"  /*--}}
                        {{--*/ $investmentStatus = $prop -> property_investment_status ? $prop -> property_investment_status  : 'N/A' /*--}}
                        {{--seeting property status color--}}
                        @if($investmentStatus == env('1_PROPERTY_STATUS'))
                            {{--*/ $color = "status_green"  /*--}}
                        @endif
                        @if($investmentStatus == env('2_PROPERTY_STATUS'))
                            {{--*/ $color = "status_red"  /*--}}
                        @endif
                        @if($investmentStatus == env('3_PROPERTY_STATUS'))
                            {{--*/ $color = "status_blue"    /*--}}
                        @endif
                        @if(!$investmentStatus || $investmentStatus == null || $investmentStatus == "")
                            {{--*/ $color =   'status_green'  /*--}}
                        @endif

                        @foreach($states as $stateName)
                            @if($stateName -> state_code == $state)
                                {{--*/ $state =   $stateName -> state_name  /*--}}
                            @endif
                        @endforeach
                        <div class="property-list-left"><img alt="image thumb" src="{{$img}}" onerror="this.src='/images/noImg.jpg'">
                        </div>

                        <div class="property-list-right">
                            <div class="row m-0">
                                <h1 class="f-arial">@if(!empty($prop -> notifications_id))<i
                                            class="icon-exclamation-sign"></i> @endif {{$prop->name}}
                                    <span class="pull-right">
                                      <span class="{{$color}}">{{$investmentStatus}}</span>
                                    </span>
                                </h1>
                                <p>{{$lender}} <br>
                                    {{$address}} {{$city}} {{$state}}</p>
                                <div class="row">
                                    <div class="col-sm-6 p-0">
                                        <div class="col-xs-6">
                                            <div>Date Purchased:</div>
                                            <div>Lender:</div>
                                            <div>Purchase Price</div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div>{{$date}}</div>
                                            <div>{{$lender}}</div>
                                            <div>{{$purchaseBook}}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 p-0">
                                        <div class="col-xs-6">
                                            <div>Block & Lot:</div>
                                            <div>Building Type:</div>
                                            <div>Market:</div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div>{{$blockLot}}</div>
                                            <div>{{$buildingType}}</div>
                                            <div>{{$market}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
