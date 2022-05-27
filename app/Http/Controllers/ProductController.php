<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class ProductController extends Controller
{
    public function vendorProducts(Vendor $vendor)
    {
        return view('products', [
            'deals'          => $vendor->deals,
            'vendorProducts' => $vendor->products,
        ]);
    }

}
