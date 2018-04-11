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
			<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#forgotPassword">Forgot password</button>
  			<button class="btn btn-primary btn-block">Log in</button>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Please take the following steps to reset your password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('reset.password')  }}">
			<div class="modal-body">
					{{ csrf_field()  }}
					<div class="form-group">
						<label for="recoveryEmail">Recovery Email address</label>
						<input type="email" class="form-control" id="recoveryEmail" name="recoveryEmail" placeholder="Recovery Email">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Send password recovery email</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection
