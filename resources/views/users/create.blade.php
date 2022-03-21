@extends('layouts.app')

@section('content')

<div class="card col-12 col-sm-6 col-md-4 mx-auto mt-4 p-3">
    <h4 class="text-center">Create New User</h4>

    <form action="{{ route('users.store') }}" method="POST" class="mt-3">
        @include('users.partials.form')
    </form>
</div>

@endsection
