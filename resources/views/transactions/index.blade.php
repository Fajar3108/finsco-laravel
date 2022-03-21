@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1>transactions</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">New</a>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success my-3">
        {{ session()->get('success') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Confirmed By</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <th>{{ ($transactions ->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}</th>
                <td>{{ $transaction->receiver>name }}</td>
                <td>{{ $transaction->confirmed_by->name }}</td>
                <td>{{ $transaction->status->name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>
                    <form action="{{ route('transactions.delete', $transaction->id) }}" method="POST" class="d-flex">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-success btn-sm" role="button">Edit</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}

@endsection
