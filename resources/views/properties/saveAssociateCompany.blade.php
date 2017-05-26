<div class="modal-body lh-40 p-b-0 f-arial">
    <div class="row m-0"><h4 class="f-arial" name="companyAddress" id="companyAddress">11 MAIN STREET LKWD, NJ
            08701</h4></div>
    <div class="row m-b-15">
        <div class="errorMessage alert alert-danger" id="errorMessageAssociateCompany"></div>
    </div>
    <div class="row m-b-15">
        <div id="associatedCompaniesTable" class="associatedCompaniesTable center-block"></div>
    </div>

    <div class="row m-b-15">
        <div class="col-md-5">
            <select class="sm-form-control" id="companies-dd" name="companies-dd">
                <option value="">Select Company</option>
                @for($i=0 ; $i < count($companies); $i++)
                    <option value="{{$companies[$i] -> id}}">{{$companies[$i] -> name}}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="row m-0 m-b-15">
        <div class="associate_box">
            <span id="investors"></span>
        </div>
    </div>

    <div class="row m-b-15">
        <div class="col-md-4">
            Investment Amount
        </div>
        <div class="col-md-4">
            <input class="sm-form-control" type="text" name="investmentAmount" id="investmentAmount">
        </div>
    </div>
    <div class="row m-b-15">
        <div class="col-md-4">
            Investment %
        </div>
        <div class="col-md-4">
            <input class="sm-form-control" type="text" name="investmentPercent" id="investmentPercent">
        </div>
    </div>

    <div class="row m-b-15 text-center m-t-40">
        <button type="button" class="btn btn-default2" onclick="saveAssociatedCompany(1, '')">save & associate another
        </button>
    </div>
</div>
<div class="modal-footer text-center brd-0 f-arial">
    <button type="button" class="button button-rounded button-red brd-radius-10 " id="associateCloseBtn">CANCEL</button>
    <button type="button" class="button button-rounded  button-yellow  brd-radius-10" id="associateSaveBtn">SAVE
    </button>
</div>