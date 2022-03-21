<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Customer</th>
            <th>Confirmed By</th>
            <th>Status</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <th>{{ ($transactions->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}</th>
            <td>{{ $transaction->code }}</td>
            <td>{{ $transaction->receiver->name }}</td>
            <td>{{ $transaction->confirmed_by->name }}</td>
            <td>{{ $transaction->status->name }}</td>
            <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
