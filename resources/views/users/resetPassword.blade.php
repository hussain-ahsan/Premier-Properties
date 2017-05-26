<form class="form-horizontal m-b-0" role="form" id="resetPasswordUserForm">
    {!! csrf_field() !!}
    <input type="hidden" value="" id="user_id" name="user_id" class="user_id">
    <div class="modal-body">

        <div class="form-group">
            <label class="col-md-4 control-label">New password:</label>
            <div class="col-md-6">
                <input type="password" class="sm-form-control" name="reset_password"
                       id="reset_password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Confirm Password:</label>
            <div class="col-md-6">
                <input type="password" class="sm-form-control" name="reset_password_confirmation"
                       id="reset_password_confirmation">
            </div>
        </div>
    </div>

    <div class="modal-footer text-center">
        <button type="button" class="button button-rounded button-red brd-radius-10 cancelResetModel">CANCEL</button>
        <button type="submit" class="button button-rounded  button-yellow  brd-radius-10">SAVE</button>
    </div>

</form>