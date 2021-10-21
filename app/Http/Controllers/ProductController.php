<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    public function all()
    {
        $product = new Product();
        return view('products', ['products'=>$product->getAll()]);
    }

    public function filter(ProductRequest $request)
    {
        $product = new Product();
        if( $request->input('filter_products') ) {
            $products = $product->filter($request->input());
            return view('products', ['products'=>$products]);
        }

        return view('products', ['products'=>$product->getAll()]);
    }
}
