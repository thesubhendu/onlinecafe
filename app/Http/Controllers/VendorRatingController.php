<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRatingController extends Controller
{
    public function store(Vendor $vendor)
    {
        request()->validate([
            'rating' => ['required', 'in:1,2,3,4,5']
        ]);

        $vendor->rate(request('rating'));
    }
}
