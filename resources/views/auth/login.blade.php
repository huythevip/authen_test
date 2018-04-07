@extends('main')

@section('title', '| Log in')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form action="{{ route('login.post')  }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" id="email" name="email" placeholder="Email">
  			</div>
  			<div class="form-group">
    			<label for="password">Password</label>
    			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
  			</div>
  			<!-- <div class="form-group">
    			<label for="confirmPassword">Confirm password</label>
    			<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password">
  			</div> -->
  			<hr>
  			<div class="form-check">
  				<input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
  				<label class="form-check-label" for="rememberMe">Remember me</label>
  			</div>
  			<button class="btn btn-primary btn-block">Log in</button>
		</form>
	</div>
</div>
@endsection