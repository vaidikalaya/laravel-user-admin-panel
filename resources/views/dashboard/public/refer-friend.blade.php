@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-header mt-2">
        <h4>
            Refer a Friend
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

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold">Invite your friend to join QuantiNova</h5>
            <p>When your friend signs up on QuantiNova, they will get 1-month FREE QuantiNova pack.</p>
            <form action="/my/refer-friend/send-invitation" method="post" class="w-50">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="referral" class="form-control bg-white only-border-bottom" value="{{auth()->user()->username}}" id="code" placeholder="code" disabled>
                    <label for="code">Referral code</label>
                </div>
                <div class="form-floating">
                    <input type="email" name="mail" class="form-control bg-white only-border-bottom" id="email" placeholder="email" required>
                    <label for="email">Friend's Email Address</label>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary2" @disabled(!auth()->user()->username)>Send</button>
                    @if(!auth()->user()->username)
                        <span class="text-danger">please, complete your profile and then share !</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection