<form class="form-horizontal" role="form" id="savePropertyReportsForm"
      enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" id="id" name="id">
    <input type="hidden" id="property_id" name="property_id" value="{{$singleProperty->id}}">
    <div class="modal-body lh-40 p-b-0 f-arial">
        <div class="alert alert-danger bootstrapMsg" id="errorMessage" style="display: none"></div>
        <div class="row m-b-15">
            <div class="col-md-4">
                <select id="property_report" name="property_report" class="sm-form-control" custom-propertyReports="{{$singleProperty -> reports}}">
                    <option value="" selected="selected">New Report</option>
                    @foreach($singleProperty -> reports as $propertyReports)
                        <option value="{{$propertyReports -> id}}">{{$propertyReports -> name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 p-0">
                <div class="col-md-5">
                    <label class="f-arial">Report Name</label>
                </div>
                <div class="col-md-7 ">
                    <input class="sm-form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="col-md-5">
                    <label class="f-arial">Report Date</label>
                </div>
                <div class="col-md-7  input-daterange travel-date-group bottommargin-sm" id="reportDateDP">
                    <input class="sm-form-control sm-form-control tleft today" type="text" name="date" id="date"
                           placeholder="MM/DD/YYYY">
                </div>
            </div>
        </div>

        <div class="row m-0">
            <label class="f-arial">Message</label>
        </div>
        <div class="row m-0 m-b-15">
            <textarea class="sm-form-control" name="comments" id="comments"></textarea>
        </div>
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <div class="col-md-6">
                    <span class=""><input type="checkbox" checked="checked" value="1" id="notify_investor"
                                          name="notify_investor"> notify investors</span>
                </div>
                <div class="col-md-6 p-r-0">
                    <input type="file" id="file_name" name="file_name" class="hidden">
                    <button type="button" class="btn btn-default2 pull-right"
                            onclick="document.getElementById('file_name').click()"><i class="icon-arrow-up"></i> UPLOAD
                        REPORT
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer text-center brd-0">
        <button type="button" class="button button-rounded button-red brd-radius-10 cancelModel">CANCEL</button>
        <button class="button button-rounded  button-yellow  brd-radius-10" id="savePropertyReportBtn">SAVE</button>
    </div>
</form>