@extends('layouts.auth')

@section('content')
    <form class="col-12 col-sm-6 col-md-4 mx-auto" method="POST" action="{{ route('login.post') }}">
        <h1 class="m-0">Welcome Back!</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        <hr>
        @csrf
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>
@endsection
