
@extends('layouts.customer-layout')

@section('content')

@if (session()->has('error'))
<div class="alert alert-danger">
    <p class="m-0">{{ session()->get('error') }}</p>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    <p class="m-0">{{ session()->get('success') }}</p>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mt-3">
    <h1>Total : {{ CurrencyHelper::rupiah($total) }}</h1>
    <form action="{{ route('transactions.store', "type=purchase") }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
</div>

<div class="row mt-3" id="products">
    @foreach ($carts as $cart)
    <div class="card col-3 p-3 mb-3">
        <img src="{{ $cart->product->image }}" alt="thumbnail" className="img-fluid rounded mb-3" style="height: 200px; width: 100%; object-fit: cover" />
        <p class="my-1">qty: {{ $cart->qty }}</p>
        <h6>{{ $cart->product->name }}</h6>
        <h6 class="m-0 text-muted">Price</h6>
        <h4 class="text-primary mb-3">{{ CurrencyHelper::rupiah($cart->product->price) }}</h4>
        <form action="{{ route('carts.delete', $cart->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-danger w-100" type="submit">Remove</button>
        </form>
    </div>
    @endforeach
</div>

@endsection
