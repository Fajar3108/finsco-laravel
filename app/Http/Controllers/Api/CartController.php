<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\{Cart, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::with('product')->where('user_id', $request->user()->id)->get();

        $total = TransactionHelper::total_price($carts);

        return ResponseHelper::success([
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'exists:products,id']
        ]);

        if($validator->fails()) return ResponseHelper::error($validator->errors(), 'Product Not Found', 404);

        $product = Product::find($request->product_id);

        if ($product->stock <= 0) return ResponseHelper::error([], 'Stock less then 0', 400);

        $product_exist = Cart::where('user_id', $request->user()->id)->where('product_id', $request->product_id)->first();

        if ($product_exist) {
            $product_exist->update([
                'qty' => $product_exist->qty + 1
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'qty' => 1
            ]);
        }

        return ResponseHelper::success();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty' => ['required', 'min:1'],
            'product_id' => ['exists:carts,product_id']
        ]);

        if ($validator->fails()) return ResponseHelper::error($validator->errors(), 'Failed to update qty', 400);

        $cart = Cart::where('user_id', $request->user()->id)->where('product_id', $request->product_id)->first();

        if ($cart->product->stock < $request->qty) return ResponseHelper::error([], 'Stock is not enough', 400);

        $cart->update([
            'qty' => $request->qty,
        ]);

        return ResponseHelper::success();
    }
}
