<?php

namespace App\Http\Controllers;

use App\Exports\TopupExport;
use App\Helpers\TransactionHelper;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->type)) abort(404);

        $transactions = Transaction::whereHas('type', function(Builder $query){
            global $request;
            $query->where('slug', $request->type);
        });

        if ($request->type == 'purchase') {
            $transactions->where('receiver_id', auth()->user()->id);
        }

        $transactions = $transactions->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        if (!isset(request()->type)) abort(404);
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        if (!isset($request->type)) abort(404);

        if ($request->type == 'top-up') return TransactionHelper::top_up($request->email, $request->amount);
        else abort(404);
    }

    public function export()
    {
        if (!isset(request()->type)) abort(404);

        if(request()->type == 'top-up') return Excel::download(new TopupExport, 'top-up.xlsx');
    }
}
