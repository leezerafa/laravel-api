@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<a href="/api-overview">Back</a>
            <div class="panel panel-default">
                <div class="panel-heading">API - {{ $apiName }}</div>
                <div class="panel-body">
                  <ul>
                  	<li>API Name - {{ $apiName }}</li>
                  	<li>API Key - {{ $apiKey }}</li>
                  	<li>API Status - {{ $apiStatus }}</li>
                  </ul>
                  Actions:
                  <a href="/api-delete/{{$apiID}}">Delete</a>
                  <a href="/api-update/{{$apiID}}">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection