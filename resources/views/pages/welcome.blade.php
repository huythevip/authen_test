@extends('main')

@section('title', '| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            <h1>Welcome to our Authentication System!</h1>
            <div class="col-md-6">
                <a class="btn btn-primary btn-block" href="{{ route('login.get')  }}">Log in</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-success btn-block" href="{{ route('register.get')  }}">Register</a>
            </div>
        </div>
    </div>

@endsection