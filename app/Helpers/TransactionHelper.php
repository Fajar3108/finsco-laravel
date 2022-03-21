<?php

namespace App\Helpers;

use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Support\Str;

class TransactionHelper {
    public static function top_up($email, $amount)
    {
        $receiver = User::where('email', $email)->first();

        if (!$receiver) return back()->with('error', 'Top Up Failed! Email Not Found');

        if ($amount <= 0) return back()->with('error', 'Top Up Failed! Amount must be more than 0');

        Transaction::create([
            'receiver_id' => $receiver->id,
            'confirmed_by_id' => auth()->user()->id,
            'type_id' => TransactionType::where('slug', 'top-up')->first()->id,
            'status_id' => TransactionStatus::where('slug', 'success')->first()->id,
            'amount' => $amount,
            'code' => 'TPP-' . Str::random(8),
        ]);

        $balance = $receiver->balance + $amount;

        $receiver->update([
            'balance' => $balance
        ]);

        return redirect()->route('transactions.index', 'type=' . 'top-up')->with('success', 'Top Up Success');
    }
}
