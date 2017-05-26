@extends('layouts.app')
@section('content')
  @include('propertyReports.propertyReportModal') {{--including property report modal --}}
  {{--*/ $lender = $singleProperty -> lender ? $singleProperty -> lender : 'N/A';    /*--}}
  {{--*/ $name = $singleProperty -> name ? $singleProperty -> name : 'N/A';    /*--}}

  @include('layouts.pageTitleSection', array('sectionName'=>'properties/ '.$name))


  {{--*/ $propStreet = $singleProperty -> street_address ? $singleProperty -> street_address . ',' : '';    /*--}}
  {{--*/ $propCity = $singleProperty -> city ? $singleProperty -> city : ''    /*--}}
  {{--*/ $color =   '';  /*--}}
  {{--*/ $investmentStatus =  $singleProperty -> property_investment_status ? $singleProperty -> property_investment_status :  'N/A';  /*--}}
  {{--*/ $investmentStatusValue =  $singleProperty -> property_investment_status ? $singleProperty -> property_investment_status . ' Investment' :  'N/A';  /*--}}

  {{--seeting property status color--}}
  {{--*/ $color = 'green';  /*--}}
  @if($investmentStatus == env('1_PROPERTY_STATUS'))
    {{--*/ $color = 'green';  /*--}}
  @endif
  @if($investmentStatus == env('2_PROPERTY_STATUS'))
    {{--*/ $color = 'red';  /*--}}
  @endif
  @if($investmentStatus == env('3_PROPERTY_STATUS'))
    {{--*/ $color = 'blue';    /*--}}
  @endif

  {{--*/ $blockLot = $singleProperty -> block_lot ? $singleProperty -> block_lot : 'N/A';  /*--}}
  {{--*/ $buildingType = $singleProperty -> building_type ? $singleProperty -> building_type : 'N/A';   /*--}}
  {{--*/ $yearBuilt = $singleProperty -> year_built ? $singleProperty -> year_built : 'N/A';  /*--}}
  {{--*/ $yearRenovated = $singleProperty -> year_renovated ? '/' . $singleProperty -> year_renovated : '';  /*--}}
  {{--*/ $buildingClass = $singleProperty -> building_class ? $singleProperty -> building_class : 'N/A';  /*--}}
  {{--*/ $lotArea = $singleProperty -> lot_area ? $singleProperty -> lot_area . ' sqf.' : 'N/A';  /*--}}
  {{--*/ $stories = $singleProperty -> stories ? $singleProperty -> stories : 'N/A';  /*--}}
  {{--*/ $market = $singleProperty -> market ? $singleProperty -> market : 'N/A';  /*--}}
  {{--INVESTMENT INFORMATION--}}

  {{--*/ $datePurchase = $singleProperty -> date_purchase ? $singleProperty -> date_purchase : 'N/A';  /*--}}
  {{--*/ $refinanceRate = $singleProperty -> refinance_interest_rate ? $singleProperty -> refinance_interest_rate . '%': 'N/A';  /*--}}
  {{--*/ $refinanceDate = $singleProperty -> refinance_interest_date ? $singleProperty -> refinance_interest_date : 'N/A';  /*--}}
  {{--*/ $purchasePrice = $singleProperty -> purchased_price ? '$' .$singleProperty -> purchased_price : 'N/A';  /*--}}
  {{--*/ $occRate = $singleProperty -> original_occupancy_rate ? $singleProperty -> original_occupancy_rate . '%' : 'N/A';  /*--}}
  {{--*/ $loanAmount = $singleProperty -> refinance_loan_amount != '' ? '$' . $singleProperty -> refinance_loan_amount : 'N/A';  /*--}}
  {{--*/ $interestRate = $singleProperty -> interest_rate != '' ?  $singleProperty -> interest_rate . '%' : 'N/A';  /*--}}
  {{--*/ $currentOccRate = $singleProperty -> current_occupancy_rate != '' ?  $singleProperty -> current_occupancy_rate . '%' : 'N/A';  /*--}}
  {{--*/ $intterestRate = $singleProperty -> interest_rate != '' ?  $singleProperty -> interest_rate . '%' : 'N/A';  /*--}}
  {{--*/$mezz_lender =  $singleProperty -> mezz_lender ? $singleProperty -> mezz_lender  : 'N/A'/*--}}
  {{--*/$mezz_interest_rate =  $singleProperty -> mezz_interest_rate ? $singleProperty -> mezz_interest_rate . '%' : 'N/A' /*--}}
  {{--*/$rate_structure =  $singleProperty -> rate_structure ? $singleProperty -> rate_structure : 'N/A' /*--}}
  {{--*/$property_class =  $singleProperty -> property_class ?  $singleProperty -> property_class : 'N/A'/*--}}
  {{--*/$original_equity_investment   = $singleProperty -> original_equity_investment  ? '$' .$singleProperty -> original_equity_investment : 'N/A' /*--}}
  {{--*/$current_equity_balance  = $singleProperty -> current_equity_balance ? '$' . $singleProperty -> current_equity_balance : 'N/A' /*--}}
  {{--*/$original_debt  = $singleProperty -> original_debt ? $singleProperty -> original_debt : 'N/A' /*--}}


  <section id="content">
    <div class="content-wrap Investors-llc">
      <div class="container clearfix ">
        <div class="row">
          <div class="col-md-7 Investors-llc-head">
            <h1> {{ $name }}</h1>
            <p>{{ $lender }}<br/>
              {{ $propStreet }} {{ $propCity }}</p>
          </div>
          <div class="col-md-5">
            @if (Auth::User() -> hasRole(env('ADMIN_ROLE')))
              <button class="btn btn-gold f-arial pull-right" id="showPropertyReportsModel">ADD/EDIT
                REPORT
              </button>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 m-b-15">
            <img alt="image thumb" src="{{asset(env('PROPERTY_IMAGE_PATH').$singleProperty->id.'/'. env('DETAIL_WIDTH').'*'.env('DETAIL_HEIGHT').'_'.$singleProperty->image )}}" onerror="this.src='/images/noImg.jpg'">
          </div>
          <div class="col-md-8">
            <div class="panel panel-default Investors-llc-list">
              <div class="panel-heading">
                <h4 class="panel-title">building information
                  <span class="pull-right">
                                  <span class="status_{{$color}}">{{$investmentStatusValue}} </span>
                  </span>
                </h4>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-xs-6">
                        Block & Lot
                      </div>
                      <div class="col-xs-6">
                        {{$blockLot}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Year Built/Renovated
                      </div>
                      <div class="col-xs-6">
                        {{$yearBuilt}}{{$yearRenovated}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Lot Area
                      </div>
                      <div class="col-xs-6">
                        {{ $lotArea }}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Building Type
                      </div>
                      <div class="col-xs-6">
                        {{$buildingType }}
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">

                    <div class="row">
                      <div class="col-xs-6">
                        Building Class
                      </div>
                      <div class="col-xs-6">
                        {{$buildingClass}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Stories
                      </div>
                      <div class="col-xs-6">
                        {{$stories}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Market
                      </div>
                      <div class="col-xs-6">
                        {{$market}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
                <p> Description of property<br>
                  {{ $singleProperty -> description_investment_property }}.</p>
              </div>
            </div>
            <div class="panel panel-default Investors-llc-list">
              <div class="panel-heading">
                <h4 class="panel-title">Investment information <span class="pull-right"></span></h4>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-6">

                    <div class="row">
                      <div class="col-xs-6">
                        Date Purchased
                      </div>
                      <div class="col-xs-6">
                        {{$datePurchase}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Lender
                      </div>
                      <div class="col-xs-6">
                        {{$lender}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Interest Rate
                      </div>
                      <div class="col-xs-6">
                        {{$interestRate}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Mezz Lender
                      </div>
                      <div class="col-xs-6">
                        {{$mezz_lender}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Mezz Interest Rate
                      </div>
                      <div class="col-xs-6">
                        {{$mezz_interest_rate}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Rate structure
                      </div>
                      <div class="col-xs-6">
                        {{$rate_structure}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Property Class
                      </div>
                      <div class="col-xs-6">
                        {{$property_class}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Purchase Price
                      </div>
                      <div class="col-xs-6">
                        {{$purchasePrice}}
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">

                    <div class="row">
                      <div class="col-xs-6">
                        Original Equity Investment
                      </div>
                      <div class="col-xs-6">
                        {{$original_equity_investment}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Current Equity Balance
                      </div>
                      <div class="col-xs-6">
                        {{$current_equity_balance}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Original Occupancy rate
                      </div>
                      <div class="col-xs-6">
                        {{$occRate}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Current Occupancy rate
                      </div>
                      <div class="col-xs-6">
                        {{$currentOccRate}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Original debt
                      </div>
                      <div class="col-xs-6">
                        {{$original_debt}}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Entity Name
                      </div>
                      <div class="col-xs-6">
                        @foreach($singleProperty -> companies as $company)
                          @if(count($company -> investors) > 0)
                            {{$company -> name}}
                          @endif
                        @endforeach
                        @if(count($singleProperty -> companies) <= 0)
                          N/A
                        @endif
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                        Managed by
                      </div>
                      <div class="col-xs-6">
                        {{$singleProperty ->  managed_by}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </div>

        <!--ac start -->
        <div class="row m-0  accordion-pp f-arial">
          <div class="accordion accordion-bg clearfix">

            @foreach($singleProperty -> reports as $propertyReports)
              {{--*/  $circle = '';  $id = "" ; /*--}}
              @if(count($propertyReports -> notifications) > 0)
                {{--*/  $id = $propertyReports -> notifications[0] -> id  ; $circle = 'icon-info';  /*--}}
              @endif
              {{--*/  $notificationID = ''; $notificationClass = ""  /*--}}
              @if(count($propertyReports -> notifications) > 0)
                {{--*/  $notificationID = $id; $notificationClass = "removeNotifications"  /*--}}
              @endif

              <div class="acctitle {{$notificationClass}}"
                   id="{{$notificationID}}">{{ $propertyReports -> name }}
                @if($notificationID != '')
                  <span id="span_{{$id}}">
                <span class="pull-right p-relative accordion-pp-right-icon"><i
                      class="icon-exclamation-sign text-gold p-18"></i></span>
                  </span>
                @endif
              </div>
              <div class="acc_content clearfix" style="display: block;">
                <p>{!! $propertyReports -> comments !!}</p>
                <!-- <button class="btn btn-default2 m-r-10"><i class="icon-download"></i> MONTHLY REPORT</button> -->
                @if($propertyReports -> file_name)
                  <a href="/download/?name={{$propertyReports -> file_name}}&env={{env('PROPERTY_REPORT_UPLOAD_PATH')}}">
                    <button class="btn btn-default2"><i class="icon-download"></i> ANNUAL REPORT
                    </button>
                  </a>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <!-- ac end-->
      </div>
    </div>
  </section>

  <script>
    window.allowedExtensions = '{{env('ALLOWED_FILE_EXTENSION')}}'
  </script>
  <script src="{{asset('assets/js/library/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/js/custom/propertyReports.js')}}"></script>
@endsection