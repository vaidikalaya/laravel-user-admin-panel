@extends('layouts.app')

@section('content')
    <div class="container" id="my-activity">

        <div class="main-header">
            <h4>My Activity</h4>
        </div>
        <hr>
        <div class="row col-10 mt-3">
            <div class="col-md-4">
                <div class="card text-center">
                    <h6>1602</h6>
                    <p>Searches</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <h6>1316</h6>
                    <p>Analytics</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <h6>1602</h6>
                    <p>Observational Studies</p>
                </div>
            </div>
        </div>
    </div>
@endsection