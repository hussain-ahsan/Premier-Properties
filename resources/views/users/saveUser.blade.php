<div class="alert alert-danger bootstrapMsg" id="errorMessage" style="display: none;"></div>
<form class="form-horizontal m-b-0" role="form" id="saveUserForm" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" value="" id="user_id" name="user_id" class="user_id">
    <div class="modal-body lh-40 p-b-0">
        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">First Name:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="first_name" id="first_name">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Last Name:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="last_name" id="last_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Address:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="address" id="address">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-1">
                    <label class="f-arial">City</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" name="city" id="city">
                </div>
                <div class="col-md-1">
                    <label class="f-arial">State</label>
                </div>
                <div class="col-md-3">
                    <select class="sm-form-control" id="state" name="state">
                        <option value="" selected="selected"></option>
                        @foreach($states as $state)
                            <option value="{{$state -> state_code}}">{{$state -> state_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="f-arial">Zip</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" name="zip" id="zip">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Home Phone:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="home_phone" id="home_phone">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-4">
                    <label class="f-arial">Cell Phone:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="cell_phone" id="cell_phone">
                </div>
            </div>
        </div>
        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Work Phone:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="work_phone" id="work_phone">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Fax Phone:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="fax_phone" id="fax_phone">
                </div>
            </div>
        </div>
        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Email 1:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="email" name="email" id="email">
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Email 2:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="email" name="email2" id="email2">
                </div>
            </div>
        </div>

        <div id="passwordSection">
            <div class="row m-b-15">
                <div class="col-md-6 p-0">
                    <div class="col-md-4">
                        <label class="f-arial">Password:</label>
                    </div>
                    <div class="col-md-8">
                        <input class="sm-form-control" type="password" name="password" id="password">
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="col-md-4 noleftpadding">
                        <label class="f-arial">Confirm Password:</label>
                    </div>
                    <div class="col-md-8">
                        <input class="sm-form-control" type="password" name="password_confirmation"
                               id="password_confirmation">
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-smf f-arial"> Disbursement Mailing Address (If other than address)</div>
        <div class="row m-b-15">
            <div class="col-md-6 p-0">
                <div class="col-md-4">
                    <label class="f-arial">Address:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" name="payment_address" id="payment_address">
                </div>
            </div>
            <div class="col-md-6 p-0 m-b-15">
                <div class="col-md-1">
                    <label class="f-arial">City</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" name="payment_city" id="payment_city">
                </div>
                <div class="col-md-1">
                    <label class="f-arial">State</label>
                </div>
                <div class="col-md-3">
                    <select class="sm-form-control" id="payment_state" name="payment_state">
                        <option value="" selected="selected"></option>
                        @foreach($states as $state)
                            <option value="{{$state -> state_code}}">{{$state -> state_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="f-arial">Zip</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="sm-form-control" name="payment_zip" id="payment_zip">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 p-0 lh-40">
                <div class="aje-panel">
                    <div id="companiesListing">
                    </div>
                    <div class="aje-panel-body">
                        <div class="row m-0 m-b-10">
                            <div class="col-xs-7">
                                <select class="sm-form-control" id="company" name="company">
                                    <option value="" selected="selected">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company -> id}}">{{$company -> name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2 p-l-0 p-r-0">% Owned</div>
                            <div class="col-xs-3 p-l-0">
                                <input class="sm-form-control" type="text" name="percent_owned" id="percent_owned">
                            </div>
                        </div>
                        <div class="text-right row m-0">
                            <div class="col-md-12 cursor_p"><a class="text-uline addo" id="addAnotherCompany">ADD ANOTHER
                                    COMPANY</a></div>
                        </div>

                        <div class="text-right row m-0">
                            <div class="col-md-12"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 p-0 m-b-15 f-arial">
                <div class="row m-0">
                    <div class="col-md-3">
                        <label class="f-arial">Permissions:</label>
                    </div>
                    <div class="col-md-5">
                        <select id="role" name="role" class="form-control">
                            <option value="" selected="selected"></option>
                            @foreach($roles as $role)
                                <option value="{{$role -> id}}">{{$role -> name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="userReport" name="userReport" class="hidden"/>
                        <input type="text" id="reportTitle" name="reportTitle" class="hidden"/>
                        <a class="f-arial cursor_p" onclick="uploadReport()"><u>Upload K1 Report</u></a>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-md-3">
                        <label class="f-arial">PW Expires:</label>
                    </div>
                    <div class="col-md-5 date input-daterange travel-date-group bottommargin-sm"
                         id="date_time_picker_pw_expire">
                        <div class="col-md-12 p-l-0 p-r-0">
                            <input type="text" class="sm-form-control tleft default" name="password_expire_date"
                                   id="password_expire_date" placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-xs-1">
                            <input type="checkbox" class="checkbox-inline" name="permanent" id="permanent"
                                   checked="checked" value="1">
                        </div>
                        <label class="f-arial">Permanent</label>
                    </div>
                </div>
                <input type="hidden" name="status" id="status">

                <div class="row m-0 hidden" id="deactivateAndReset">
                    <div class="col-xs-3 hidden-xs">
                        <label class="f-arial">&nbsp;</label>
                    </div>
                    <div class="col-xs-4 col-sm-4 p-r-0">
                        <button type="button" class="btn btn-default2" id="deactivateBtn"><span id="activateBtnText">DEACTIVATE </span>
                        </button>

                    </div>
                    <div class="col-xs-4 col-sm-4 p-l-0">
                        <button type="button" class="btn btn-default2" id="resetPassword">RESET PASSWORD</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="modal-footer text-center">
        <button type="button" class="button button-rounded button-red brd-radius-10 cancelModel">CANCEL</button>
        <button type="submit" class="button button-rounded  button-yellow  brd-radius-10" id="saveUserBtn">SAVE</button>
    </div>

</form>