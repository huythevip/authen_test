@extends('main')

@section('title', '| Reset Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{ route('update.password', $token)  }}" method="POST">
                {{ csrf_field() }}
                <input type="password" class="hidden " name="userChangePassword" value=" {{ $user->email }} ">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password">
                </div>
                <hr>
                <button class="btn btn-primary btn-block">Change Password</button>
            </form>
        </div>
    </div>


@endsection
