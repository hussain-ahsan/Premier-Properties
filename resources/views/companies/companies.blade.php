@extends('layouts.app') {{--including layout file--}}
@section('content') {{-- starting content file--}}
@include('companies/modal') {{--including modal --}}
@include('layouts.pageTitleSection', array('sectionName'=>'Companies'))
<script type="text/javascript" src="{{asset('assets/js/custom/companies.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/general.js')}}"></script>

<!-- #content start -->
<section id="content">
    <div class="content-wrap companies-table">
        <div class="container clearfix">
            <div class="row m-0">
                <a type="button" class="button button-rounded button-yellow button-small add-new-btn" id="addCompany">ADD
                    NEW
                </a>
            </div>
            <div class="table-responsive">
                <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Main Contact</th>
                        <th>EIN</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created</th>
                        <th>Created by</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($company as $companies)
                        <tr>
                            {{--*/
                            $createdBy = $companies -> companyCreatedByUser -> first_name . ' ' .$companies -> companyCreatedByUser -> last_name
                            /*--}}
                            <td>{{$companies['name']}}</td>
                            <td>{{$companies['contact']}}</td>
                            <td>{{$companies['ein']}}</td>
                            <td>{{$companies['phone']}}</td>
                            <td>{{$companies['email']}}</td>
                            <td>{{$companies['address']}}</td>
                            <td>{{$companies['created_at']}}</td>
                            <td>{{$createdBy}}</td>
                            {{--*/
                            $jsonObject = array( "name" => $companies['name'], "ein" => $companies['ein'], "phone" => $companies['phone'], "email" => $companies['email'], "contact" => $companies['contact'], "address" => $companies['address'], "city" => $companies['city'], "states" => $companies['states'], "zip" => $companies['zip'], "id" => $companies['id'] )
                            /*--}}
                            <td custom-data="{{json_encode($jsonObject)}}" onclick='editCompany(this)'><a href="#"><u>Edit</u></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- #content end -->

@endsection
