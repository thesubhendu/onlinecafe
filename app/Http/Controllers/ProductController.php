<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function vendorproducts($vendor)
    {
        $products = Product::where('vendor_id', $vendor)
        ->with('vendor')
        ->get();

        $featured = Product::inRandomOrder('vendor_id', $vendor)
        ->take(1)
        ->get();



        return view('products', [
            'vendorproducts' => $products,
            'featured' => $featured
        ]);
    }

}
