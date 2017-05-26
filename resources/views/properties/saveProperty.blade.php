<form class="form-horizontal m-b-0" accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="POST"
      id="propertyForm" name="propertyForm">
    {!! csrf_field() !!}
    <input type="hidden" value="" id="property_id" name="property_id">
    <input type="hidden" value="" id="image_name" name="image_name">
    <div class="modal-body lh-40 p-b-0">
        <div class="row m-0">
            <div class="col-md-8 p-0 m-b-15">
                <select name="property-dd" id="property-dd" class="sm-form-control f-arial">
                    <option value="0">New Property</option>
                    @foreach($properties as $property)
                        <option value="{{$property->id}}">{{$property-> name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 p-0 m-b-15">
                <input type="button" class="btn btn-default2 f-arial pull-right" value="ASSOCIATE COMPANY"
                       onclick="associateCompany()"/>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Property Name</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="name" name="property_name">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Current Equity Balance</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="current_equity_balance"
                           name="current_equity_balance">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-1">
                    <label class="f-arial">City</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" id="city" name="city">
                </div>
                <div class="col-md-1">
                    <label class="f-arial">State</label>
                </div>
                <div class="col-md-3">
                    <select class="sm-form-control" id="state" name="state">
                        @foreach($states as $state)
                            <option value="{{$state -> state_code}}">{{$state -> state_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="f-arial">Zip</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" id="zip" name="zip">
                </div>
            </div>

            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Purchased Price:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="sm-form-control" id="purchased_price" name="purchased_price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Street Address</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="street_address" name="street_address">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Sale Price</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="sale_price" name="sale_price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Lender</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="lender" name="lender">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Original Occupancy Rate</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="original_occupancy_rate"
                           name="original_occupancy_rate">
                </div>
            </div>
        </div>
        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Interest Rate</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="interest_rate" name="interest_rate">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Date of Purchase</label>
                </div>
                <div class="col-md-8 date input-daterange travel-date-group bottommargin-sm" id="date_of_purchase">
                    <input class="sm-form-control tleft today" type="text" id="date_purchase" name="date_purchase"
                           placeholder="MM/DD/YYYY">
                </div>
            </div>
        </div>
        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Rate Structure</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="rate_structure" name="rate_structure">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Current Occupancy Rate</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="current_occupancy_rate"
                           name="current_occupancy_rate">
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Mezz Lender</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="mezz_lender" name="mezz_lender">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Block and Lot</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="block_lot" name="block_lot">
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Mezz Interest Rate</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="mezz_interest_rate" name="mezz_interest_rate">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Year Built/Renovated</label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 input-daterange travel-date-group bottommargin-sm" id="year_renovated_DP">
                            <input type="text" placeholder="YYYY" class="sm-form-control tleft year" value=""
                                   id="year_built" name="year_built">
                        </div>
                        <div class="col-md-6 input-daterange travel-date-group bottommargin-sm" id="year_built_DP">
                            <input type="text" placeholder="YYYY" class="sm-form-control tleft default" value=""
                                   id="year_renovated" name="year_renovated">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Refinance Date</label>
                </div>
                <div class="col-md-8 input-daterange travel-date-group bottommargin-sm" id="ref_date">
                    <input class="sm-form-control tleft today" type="text" name="refinance_date" id="refinance_date"
                           placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Lot Area</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="lot_area" name="lot_area">
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Refinance Loan Amount</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="refinance_loan_amount" name="refinance_loan_amount">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Building Type</label>
                </div>
                <div class="col-md-8">
                    <select name="building_type" id="building_type" class="sm-form-control">
                        <option value="">Building Type</option>
                        @foreach(config('app.buildingTypes') as $bt)
                            <option value="{{$bt}}">{{$bt}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Refinance Interest Rate</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="refinance_interest_rate"
                           name="refinance_interest_rate">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Building Class</label>
                </div>
                <div class="col-md-8">
                    <select name="building_class" id="building_class" class="sm-form-control">
                        <option value="">Building Class</option>
                        @foreach(config('app.buildingClass') as $bc)
                            <option value="{{$bc}}">{{$bc}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">IRR (if sold)</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="irr" name="irr">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Property Class</label>
                </div>
                <div class="col-md-8">
                    <select name="property_class" id="property_class" class="sm-form-control">
                        <option value="">Property Class</option>
                        @foreach(config('app.buildingClass') as $propertyClass)
                            <option value="{{$propertyClass}}">{{$propertyClass}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Holding Period (if sold)</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="holding_period" name="holding_period">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Managed By</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="managed_by" name="managed_by">
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">ROI (if sold)</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="roi" name="roi">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Market</label>
                </div>
                <div class="col-md-8">
                    <select name="market" id="market" class="sm-form-control">
                        <option value="">Market</option>
                        @foreach(config('app.buildingMarket') as $bm)
                            <option value="{{$bm}}">{{$bm}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Original Debt</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="original_debt" name="original_debt">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Number of Stories</label>
                </div>
                <div class="col-md-8">
                    <select name="stories" id="stories" class="sm-form-control">
                        <option value="">Stories</option>
                        @for($i=1; $i<=100; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial lh-18">Original Equity Investment</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="original_equity_investment"
                           name="original_equity_investment">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial lh-18">Description of Investment/Property</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="description_investment_property"
                           name="description_investment_property">
                </div>
            </div>
        </div>

        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial lh-18">Property/Investment Status</label>
                </div>
                <div class="col-md-8">
                    <select name="property_investment_status" id="property_investment_status" class="sm-form-control">
                        <option value="">Property Status</option>
                        @foreach(config('app.propertyStatus') as $ps)
                            <option value="{{$ps}}">{{$ps}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div>
                    <img id="sampleImage" alt="image thumb" src="images/noImg.jpg" class="sampleImg" onerror="this.src='/images/noImg.jpg'">
                </div>
                <div id="imagePreview" style="display: none"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">

                    <input type="file" id="uploadImage" name="uploadImage" class="fa fa-upload displayNone"/>
                    <button type="button" class="btn btn-default2"
                            onclick="document.getElementById('uploadImage').click()"><i class="icon-arrow-up"></i>
                        upload image
                    </button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer text-center brd-0 f-arial">
        <button type="button" class="button button-rounded button-red brd-radius-10 "
                onclick="$('.modal').modal('hide');" id="cancelPropertyBtn">CANCEL
        </button>
        <button type="submit" class="button button-rounded  button-yellow  brd-radius-10" id="addPropertyBtn">SAVE
        </button>
    </div>
</form>