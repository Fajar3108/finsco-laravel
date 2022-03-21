<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TopupExport implements FromView
{
    public function view(): View
    {
        return view('transactions.export', [
            'transactions' => Transaction::where('type_id', 1)->latest()->get()
        ]);
    }
}
