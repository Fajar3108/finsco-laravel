<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function purchase(Request $request)
    {
        $carts = Cart::where('user_id', $request->user()->id)->get();

        if ($carts->count() <= 0) return ResponseHelper::error([], 'Cart is empty', 400);

        $total = TransactionHelper::total_price($carts);

        if ($request->user()->balance < $total) return ResponseHelper::error([], 'Balance not enough');

        foreach ($carts as $cart) {
            $transaction = Transaction::create([
                'receiver_id' => $cart->product->user_id,
                'sender_id' => $request->user()->id,
                'product_id' => $cart->product->id,
                'type_id' => TransactionType::where('slug', 'purchase')->first()->id,
                'status_id' => TransactionStatus::where('slug', 'pending')->first()->id,
                'code' => 'PRC-' . Str::random(8),
                'amount' => $cart->product->price,
                'qty' => $cart->qty,
            ]);

            $request->user()->update([
                'balance' => $request->user()->balance - ($cart->product->price * $cart->qty)
            ]);

            $transaction->receiver()->update([
                'balance' => $transaction->receiver->balance + ($transaction->amount * $transaction->qty)
            ]);
        }

        Cart::where('user_id', $request->user()->id)->delete();

        return ResponseHelper::success([], 'Purchase success');
    }
}
