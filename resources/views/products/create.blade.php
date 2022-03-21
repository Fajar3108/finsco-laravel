@extends('layouts.app')

@section('content')

<div class="card col-12 col-sm-6 col-md-6 col-lg-4 mx-auto mt-4 p-3">
    <h4 class="text-center">Create New Product</h4>

    <form action="{{ route('products.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
        @include('products.partials.form')
    </form>
</div>

@endsection
