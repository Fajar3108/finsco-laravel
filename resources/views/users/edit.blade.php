@extends('layouts.app')

@section('content')

<div class="card col-12 col-sm-6 col-md-4 mx-auto mt-4 p-3">
    <h4 class="text-center">Edit User</h4>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-3">
        @method('PUT')
        @include('users.partials.form')
    </form>
</div>

@endsection
