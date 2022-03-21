@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1>Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">New</a>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success my-3">
        {{ session()->get('success') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-flex">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm" role="button">Edit</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

@endsection
