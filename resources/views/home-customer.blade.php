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

<div class="row mt-3" id="products">
    @foreach ($products as $product)
        <div class="card col-3 p-3 mb-3">
        <img src="{{ $product->image }}" alt="thumbnail" className="img-fluid rounded mb-3" style="height: 200px; width: 100%; object-fit: cover" />
        <h6 class="mt-3">{{ $product->name }}</h6>
        <h6 class="m-0 text-muted">Price</h6>
        <h4 class="text-primary mb-3">{{ CurrencyHelper::rupiah($product->price) }}</h4>
        <form action="{{ route('carts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button class="btn btn-primary w-100">Add To Cart</button>
        </form>
    </div>
    @endforeach
</div>

@endsection
