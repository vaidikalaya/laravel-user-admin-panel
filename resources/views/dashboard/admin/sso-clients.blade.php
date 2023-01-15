@extends('layouts.app')

@section('content')
    @php
      $ssoClients=Illuminate\Support\Facades\DB::table('oauth_clients')->get();
    @endphp
    <div class="main-header">
        <h4>SSO Clients</h4>
    </div>
    <hr>
 
    <div class="card">
        <div class="card-body">
            <table id="dataTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">id</th>
                        <th scope="col">Secret</th>
                        <th scope="col">Redirect</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ssoClients as $index=>$client)
                        @if($client->redirect!='http://localhost')
                            <tr>
                                <td>{{$client->name}}</td>
                                <td>{{$client->id}}</td>
                                <td>{{$client->secret}}</td>
                                <td>{{$client->redirect}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection