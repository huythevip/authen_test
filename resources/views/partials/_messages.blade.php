@if(Session::has('messageSuccess'))
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-success">
				<strong>{{ Session::get('messageSuccess') }}</strong>
			</div>
		</div>
	</div>

@endif

@if(Session::has('messageFail'))
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-danger">
				<strong>{{ Session::get('messageFail') }}</strong>
			</div>
		</div>
	</div>

@endif


@if (count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach  
		</ul>
	</div>

@endif