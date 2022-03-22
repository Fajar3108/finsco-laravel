<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Helpers\TransactionHelper;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->latest()->get();

        $total = TransactionHelper::total_price($carts);

        return view('carts.index', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        $product = Product::find($request->product_id);

        if ($product->stock <= 0) return back()->with('error', 'Out of stock');

        $product_exist = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();

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

        return back()->with('success', 'Success add product to cart');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Deleted product from cart successfuly');
    }
}
