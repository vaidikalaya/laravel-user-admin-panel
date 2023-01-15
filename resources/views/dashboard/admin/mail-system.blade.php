@extends('layouts.app')

@section('content')
    <div class="main-header">
        <h4>Mail System</h4>
    </div>
    <hr>
 
    <form action="{{route('mail-send')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header bg-white border-0">
                <button class="btn btn-primary2" type="submit">Send</button>
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
                
                <hr>
            </div>
            <div class="card-body" style="margin-top:-30px">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="subject" class="form-control bg-white only-border-bottom" id="subject" placeholder="subject" required>
                            <label for="subject">Subject</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-floating mb-3">
                            <input type="email" name="mailto" class="form-control bg-white only-border-bottom" id="to" placeholder="to@example.com" required>
                            <label for="to">To</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-floating mb-3">
                            <input type="email" name="mailfrom" class="form-control bg-white only-border-bottom" value="support@quantinova.ai" id="from" placeholder="from@example.com" disabled>
                            <label for="from">From</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <textarea id="summernote" name="content"></textarea>
                </div>
            </div>
        </div>
    </form>
@endsection