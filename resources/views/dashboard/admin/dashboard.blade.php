@extends('layouts.app')

@section('content')
    @php
        $total_users=App\Models\User::count();
        $total_plans=App\Models\Subscription_plan::count();
        $total_sso=Illuminate\Support\Facades\DB::table('oauth_clients')->count();
    @endphp
    <div id="admin-dahsboard">
        <div class="main-header">
            <h4>Dashboard</h4>
        </div>
        <hr>

        <div class="row col-10 mt-3">
            <div class="col-md-4">
                <div class="card text-center">
                    <h6>{{$total_users}}</h6>
                    <p>Registered User</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <h6>{{$total_sso}}</h6>
                    <p>SSO Clients</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <h6>{{$total_plans}}</h6>
                    <p>Subscription Plans</p>
                </div>
            </div>
        </div>
    </div>
@endsection