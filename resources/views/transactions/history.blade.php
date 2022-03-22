
@extends('layouts.customer-layout')

@section('content')

<h4 class="my-3">My Transactions</h4>

<table class="table">
    <tr>
        <th>#</th>
        <th>Product</th>
        <th>Price</th>
        <th>qty</th>
        <th>Total</th>
        <th>Date</th>
    </tr>
    @foreach ($transactions as $transaction)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $transaction->product->name }}</td>
        <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
        <td>{{ $transaction->qty }}</td>
        <td>{{ CurrencyHelper::rupiah($transaction->qty * $transaction->amount) }}</td>
        <td>{{ $transaction->created_at->format('h:m d F Y') }}</td>
    </tr>
    @endforeach
</table>

@endsection
