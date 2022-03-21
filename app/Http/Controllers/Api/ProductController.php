<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('name', 'slug', 'stock', 'price', 'image')->latest()->orderBy('stock', 'DESC')->paginate(2);

        return ResponseHelper::paginate($products, 'Get All Products');
    }

    public function show($id)
    {
        $product = Product::with('user')->find($id);

        return ResponseHelper::success($product);
    }
}
