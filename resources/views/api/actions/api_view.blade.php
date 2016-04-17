@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">API - {{ $apiName }}</div>
                <div class="panel-body">
                  <ul>
                  	<li>API Name - {{ $apiName }}</li>
                  	<li>API Key - {{ $apiKey }}</li>
                  	<li>API Status - {{ $apiStatus }}</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection