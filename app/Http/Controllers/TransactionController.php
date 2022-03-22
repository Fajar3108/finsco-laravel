<?php

namespace App\Http\Controllers;

use App\Exports\TopupExport;
use App\Helpers\TransactionHelper;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

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

    public function history()
    {
        $transactions = Transaction::where('sender_id', auth()->user()->id)->where('product_id', '!=', null)->latest()->get();
        // dd($transactions);
        return view('transactions.history', compact('transactions'));
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
        else if ($request->type == 'purchase') {
            $carts = Cart::where('user_id', auth()->user()->id)->get();

            if ($carts->count() <= 0) return back()->with('error', 'Cart is empty');

            $total = TransactionHelper::total_price($carts);

            if (auth()->user()->balance < $total) return back()->with('error', 'Balance not enough');

            foreach ($carts as $cart) {
                $transaction = Transaction::create([
                    'receiver_id' => $cart->product->user_id,
                    'sender_id' => auth()->user()->id,
                    'product_id' => $cart->product->id,
                    'type_id' => TransactionType::where('slug', 'purchase')->first()->id,
                    'status_id' => TransactionStatus::where('slug', 'pending')->first()->id,
                    'code' => 'PRC-' . Str::random(8),
                    'amount' => $cart->product->price,
                    'qty' => $cart->qty,
                ]);

                auth()->user()->update([
                    'balance' => auth()->user()->balance - ($cart->product->price * $cart->qty)
                ]);

                $transaction->receiver()->update([
                    'balance' => $transaction->receiver->balance + ($transaction->amount * $transaction->qty)
                ]);
            }

            Cart::where('user_id', auth()->user()->id)->delete();

            return back()->with('success', 'Purchase success');
        }
        else abort(404);
    }

    public function export()
    {
        if (!isset(request()->type)) abort(404);

        if(request()->type == 'top-up') return Excel::download(new TopupExport, 'top-up.xlsx');
    }
}
