@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Api</div>
                <div class="panel-body">
					<p>To create a new API, simply give it a name, upon success you will be given your Api Key</p>
					{!! Form::open() !!}
						{!! Form::label('Api Name') !!}
						{!! Form::text('api_name') !!}
						{!! Form::Submit('Create New Api') !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 