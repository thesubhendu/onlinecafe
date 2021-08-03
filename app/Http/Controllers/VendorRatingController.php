<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRatingController extends Controller
{
    public function index(Vendor $vendor)
    {
        @dd($vendor);
        $ratings = Rating::where('vendor_id', $vendor->id);
        dd($ratings);

        return view('rate')
            ->with('vendor_rating', $vendor)
            ->with('ratings', $ratings);
    }


    public function store(Vendor $vendor)
    {
        request()->validate([
            'rating' => ['required', 'in:1,2,3,4,5']
        ]);

        $vendor->rate(request('rating'));
    }
}
