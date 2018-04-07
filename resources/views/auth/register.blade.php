@extends('main')

@section('title', '| Sign Up')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form action="{{ route('register.post') }}" method="POST">
			{{ csrf_field() }}
      <div class="form-group">
          <label for="name">Your name</label>
          <input type="name" class="form-control" id="name" name="name" placeholder="">
        </div>
			<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" id="email" name="email" placeholder="Email">
  			</div>
  			<div class="form-group">
    			<label for="password">Password</label>
    			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
  			</div>
  			<div class="form-group">
    			<label for="confirmPassword">Confirm password</label>
    			<input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password">
  			</div>
  			<hr>
  			<button class="btn btn-primary btn-block">Sign Up</button>
		</form>
	</div>
</div>
@endsection