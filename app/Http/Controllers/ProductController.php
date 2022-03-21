<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products()->latest()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'proudct' => new Product(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $image = ImageHelper::store($request->image, 'products');

        Product::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Product::latest()->first()->id + 1,
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfuly');
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->user()->id) abort(403);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($product->user_id !== auth()->user()->id) abort(403);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfuly');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted successfuly');
    }
}
