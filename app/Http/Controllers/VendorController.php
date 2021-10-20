<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class VendorController extends Controller
{

    public function show($id)
    {
        $vendor = Vendor::where('id', $id)->firstOrFail();

        return view('vendor')
            ->with('vendor', $vendor)
            ->with('products');
    }

}
