<div id="companyElement">
    <div class="modal-body m-b-0 lh-40">
        <div class="alert alert-success bootstrapMsg" id="successMessage" style="display: none">
            <strong>Success!</strong> Company has been saved.
        </div>
        <div class="alert alert-danger bootstrapMsg" id="errorMessage" style="display: none">
            <strong>Danger!</strong> Please fill all the required fields.
        </div>

        <form class="form-horizontal m-b-0" role="form" method="POST" id="companyForm" name="companyForm">
            {!! csrf_field() !!}
            <input type="hidden" value="" id="company_id" name="company_id">


            <div class="row m-b-15{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Company name:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('name') }}</strong> </span>
                </div>
            </div>

            <div class="row m-b-15{{ $errors->has('ein') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Company EIN:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="ein" name="ein" value="{{ old('ein') }}">
                    @if ($errors->has('ein'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('ein') }}</strong> </span>
                </div>
            </div>


            <div class="row m-b-15{{ $errors->has('phone') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Company Phone:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="phone" name="phone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('phone') }}</strong> </span>
                </div>
            </div>


            <div class="row m-b-15{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Company Email:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('email') }}</strong> </span>
                </div>
            </div>


            <div class="row m-b-15{{ $errors->has('contact') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Main Contact:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="contact" name="contact" value="{{ old('contact') }}">
                    @if ($errors->has('contact'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('contact') }}</strong> </span>
                </div>
            </div>

            <div class="row m-b-15{{ $errors->has('address') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <label class="f-arial">Company Address:</label>
                </div>
                <div class="col-md-8">
                    <input class="sm-form-control" type="text" id="address" name="address" value="{{ old('address') }}">
                    @if ($errors->has('address'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('address') }}</strong> </span>
                </div>
            </div>

            <div class="row m-b-15">
                <div class="col-md-1{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label class="f-arial">City:</label>
                </div>
                <div class="col-md-3">
                    <input class="sm-form-control" type="text" id="city" name="city">
                    @if ($errors->has('city'))
                        <span class="help-block">
           @endif
                            <strong>{{ $errors->first('city') }}</strong> </span>
                </div>

                <div class="col-md-1{{ $errors->has('states') ? ' has-error' : '' }}">
                    <label class="f-arial">State:</label>
                </div>
                <div class="col-md-3">
                    <select class="form-control " id="states" name="states">
                        @foreach($states as $state) {
                        <option value="{{$state -> state_code}}">{{$state -> state_name}}</option>
                        } @endforeach
                    </select>
                    @if ($errors->has('states'))
                        <span class="help-block">
         @endif
                            <strong>{{ $errors->first('states') }}</strong> </span>
                </div>

                <div class="col-md-1{{ $errors->has('zip') ? ' has-error' : '' }}">
                    <label class="f-arial">Zip:</label>
                </div>
                <div class="col-md-3">
                    <input class="sm-form-control" type="text" id="zip" name="zip">
                    @if ($errors->has('zip'))
                        <span class="help-block">
         @endif
                            <strong>{{ $errors->first('zip') }}</strong> </span>
                </div>

            </div>

            <div class="modal-footer text-center">
                <button type="button" class="button button-rounded button-red brd-radius-10" data-dismiss="modal"
                        id="cancelCompanyBtn">Close
                </button>
                <button type="submit" class="button button-rounded  button-yellow  brd-radius-10" id="addCompanyBtn">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>