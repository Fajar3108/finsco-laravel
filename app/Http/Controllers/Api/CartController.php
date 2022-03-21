<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::with('product')->where('user_id', $request->user()->id)->get()->groupBy('product_id');

        $total = 0;

        foreach($carts as $key => $cart) {
            $total += $cart->count() * Product::find($key)->price;
        }

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

        $product_exist = Cart::where('user_id', $request->user()->id)->where('product_id', $request->product_id)->first();

        if ($product_exist) {
            $product_exist->update([
                'qty' => $product_exist->qty + 1
            ]);
        }

        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'qty' => 1
        ]);

        return ResponseHelper::success();
    }
}
