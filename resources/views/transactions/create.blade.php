@extends('layouts.app')

@section('content')
    @php
        $type = \App\Models\TransactionType::where('slug', request()->type)->first();
    @endphp

    <div class="card col-12 col-sm-6 col-lg-4 mx-auto mt-3 p-3">
        <h4 class="mb-3 text-center">{{ $type->name }}</h4>
        @if (session()->has('error'))
        <div class="alert alert-danger mb-3">
            {{ session()->get('error') }}
        </div>
        @endif
        @if ($type->slug == 'top-up')
        @include('transactions.partials.top-up-form')
        @endif
    </div>
@endsection
