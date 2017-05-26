@extends('layouts.app') {{--including layout file--}}
@section('content') {{-- starting content file--}}
@include('users.userModal') {{--including modal --}}
@include('users.userReportModal') {{--including modal --}}
@include('users.resetPasswordModal') {{--including modal --}}

        <!-- Page Title
============================================= -->
@include('layouts.pageTitleSection', array('sectionName'=>'Users'))
        <!-- #page-title end -->

<!-- Content
      ============================================= -->
<section id="content">
    <div class="content-wrap companies-table ">
        <div class="container clearfix">
            <div class="row m-0">
                <a type="button" class="button button-rounded button-yellow button-small add-new-btn"
                   id="showUserModel">ADD NEW
                </a>
            </div>
            <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Company</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Permissions</th>
                        <th>Investments</th>
                        <th>PW Expires</th>
                        <th>Last Login</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($userListing as $user)
                        <tr>
                            <td>
                                {{\App\Http\userCompany($user->companies)}}
                            </td>
                            <td>{{$user -> first_name}}</td>
                            <td>{{$user -> last_name}}</td>
                            <td>{{count($user->roles) > 0 ? $user->roles[0]->name : 'N/A'}}</td>
                            <td>
                                {{\App\Http\userProperty($user->companies)}}
                            </td>
                            <td>
                                {{\App\Http\userPasswordExpireDate($user)}}
                            </td>
                            <td>{{$user->last_login == '' ? 'N/A' : $user->last_login}}</td>
                            <td>{{$user -> created_at}}</td>
                            <td>{{\App\Http\createdByUser($user)}}</td>
                            <td>{{$user ->status == 1 ? 'Active' : 'Deactive'}}</td>
                            <td><a custom-data="{{\App\Http\editUser($user)}}" onclick='editUserData(this)'
                                   class="cursor_p"> Edit </a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- #content end -->
<script>
    window.allowedExtensions = '{{env('ALLOWED_FILE_EXTENSION')}}'
</script>
<script src="{{asset('assets/js/custom/general.js')}}"></script>
<script src="{{asset('assets/js/custom/users.js')}}"></script>
@endsection