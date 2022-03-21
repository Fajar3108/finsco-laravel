<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Customer</th>
        <th>Confirmed By</th>
        <th>Status</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->code }}</td>
            <td>{{ $transaction->receiver->name }}</td>
            <td>{{ $transaction->confirmed_by->name }}</td>
            <td>{{ $transaction->status->name }}</td>
            <td>{{ $transaction->amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
