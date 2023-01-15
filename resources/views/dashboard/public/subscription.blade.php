@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="main-header mt-2">
        <h4>
            Subscription
            @if(session('error_msg'))
                <span class="alert alert-danger alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                    {{session('error_msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                </span>
            @endif
        </h4>
    </div>
    <hr>

    <div class="d-flex justify-content-center mt-3">
        <div class="card user-card shadow-sm">
            @if($plan)
                <div class="card-body" style="margin-top:0">
                    
                    <div class="row mt-3">
                        <div class="col-6 col-sm-3 fw-bold text-primary2">Subscription Pack</div>
                        <div class="col-6 col-sm-3">{{$plan->plan_detail->plan_name}}</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6 col-sm-3 fw-bold text-primary2">Valid till</div>
                        <div class="col-6 col-sm-3">
                            {{ \Carbon\Carbon::parse($plan->expire_at)->format('d/m/Y')}}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6 col-sm-3 fw-bold text-primary2">Amount paid</div>
                        <div class="col-6 col-sm-3">${{$plan->plan_detail->paid_price}}</div>
                    </div>

                    <div class="row mt-3">
                        <a href="/my/invoice-download">Download Invoice</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection