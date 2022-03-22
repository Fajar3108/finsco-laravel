@extends('layouts.app')

@section('content')

    @php
        $type = \App\Models\TransactionType::where('slug', request()->type)->first();
    @endphp

    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1>{{ $type->name }}</h1>
        <div>
            <a href="{{ route('transactions.create', 'type=' . $type->slug) }}" class="btn btn-primary">Add</a>
            <a href="{{ route('transactions.export', 'type=' . $type->slug) }}" class="btn btn-info">Export</a>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success my-3">
        {{ session()->get('success') }}
    </div>
    @endif

    @if ($type->slug == 'top-up')
        @include('transactions.partials.top-up-table')
    @elseif($type->slug == 'purchase')
        @include('transactions.partials.purchase-table')
    @endif


    {{ $transactions->links() }}

@endsection
