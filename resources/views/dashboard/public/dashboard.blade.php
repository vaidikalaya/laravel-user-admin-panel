@extends('layouts.app')
@php  @endphp
@section('content')
    <div class="container-fluid">
        <div class="main-header mt-2">
            <h4>
                Dashboard
                @if(session('success_msg'))
                    <span class="alert alert-success alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                        {{session('success_msg')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                    </span>
                @endif
                @if(session('error_msg'))
                    <span class="alert alert-danger alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                       {{session('error_msg')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                    </span>
                @endif
            </h4>
        </div>
        <hr>

        <div class="d-flex justify-content-center">
            <div class="card user-card shadow-sm">
                <div class="card-header border-bottom-0 fw-bold">
                    Basic Details
                    <hr>
                </div>
                <div class="card-body text-muted">
                    
                    <div class="row">
                        <div class="col-6 col-sm-3">User Name</div>
                        <div class="col-6 col-sm-3">
                            {{$user->username}}
                        </div>
                        <div class="col-6 col-sm-3">Full Name</div>
                        <div class="col-6 col-sm-3">
                            {{$user->firstname.' '.$user->lastname }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6 col-sm-3">Email</div>
                        <div class="col-6 col-sm-3">{{$user->email}}</div>
                        <div class="col-6 col-sm-3">Phone Number</div>
                        <div class="col-6 col-sm-3">{{$user->phone}}</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6 col-sm-3">Country</div>
                        <div class="col-6 col-sm-3">@if($user->country) {{$user->country->name}} @endif</div>
                        <div class="col-6 col-sm-3">Domain</div>
                        <div class="col-6 col-sm-3">{{$user->roles[0]->name}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <div class="card user-card shadow-sm">
                <div class="card-header border-bottom-0 fw-bold">
                    Account Password
                    <a href="" class="btn float-end" style="margin-top: -7px;" data-bs-toggle="modal" data-bs-target="#changePassword">
                        <svg viewBox="0 0 512 512" height="20" width="20">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </a>
                    <hr>
                </div>
                <div class="card-body text-muted">
                    <div class="row">
                        <div class="col-6 col-sm-3">Current Password</div>
                        <div class="col-6 col-sm-3 mt-1">*******</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePassword"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                  Change Password
                </div>
                <div class="modal-body">
                    <form action="/my/password/update" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="currentpassword" id="currentpassword" placeholder="currentpassword" required>
                            <label for="currentpassword">Current Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="newpassword" required>
                            <label for="newpassword">New Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="confirmpassword" required>
                            <label for="confirmpassword">Confirm Password</label>
                        </div>

                        <div>
                            <button class="btn btn-primary2" type="submit">Update</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection