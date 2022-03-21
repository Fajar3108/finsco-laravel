@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1>My Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">New</a>
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
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ ($products ->currentpage()-1) * $products ->perpage() + $loop->index + 1 }}</th>
                <td><p class="text-limit-1">{{ $product->name }}</p></td>
                <td><p class="text-limit-1">{{ $product->description }}</p></td>
                <td>{{ CurrencyHelper::rupiah($product->price) }}</td>
                <td>{{ number_format($product->stock, '0', ',', '.') }}</td>
                <td>
                    <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-flex">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success btn-sm" role="button">Edit</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

@endsection
