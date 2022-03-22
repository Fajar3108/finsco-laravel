<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Customer</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>qty</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <th>{{ ($transactions->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}</th>
            <td>{{ $transaction->code }}</td>
            <td>{{ $transaction->sender->name }}</td>
            <td>{{ $transaction->product_id }}</td>
            <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
            <td>{{ $transaction->qty }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
