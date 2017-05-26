<div class="modal-body f-arial m-b-15">
    <div class="errorMessage alert alert-danger err-msg-user-report col-md-12" id="errorMessageUserReport"
         style="display: none;">Please fill all the required fields
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <input type="text" id="reportTitlePopUp" class="sm-form-control" placeholder="Report Name"
                   onkeyup="$('#reportTitle').val($( '#reportTitlePopUp').val());">
        </div>

        <div class="col-sm-6 text-right">
       <span onclick="document.getElementById('userReport').click()" class="f-arial cursor_p "><u>Upload k1 Report</u>
        </span>
            <span id="selectedFile" class="hidden">(Selected File)</span>
        </div>
    </div>

</div>

<div class="modal-footer text-center f-arial">
    <button type="button" class="button button-rounded button-red brd-radius-10" onclick="closeUserReportModal();">
        CANCEL
    </button>
    <button type="button" class="button button-rounded  button-yellow  brd-radius-10" onclick="saveUserReportModal();">
        SAVE
    </button>
</div>