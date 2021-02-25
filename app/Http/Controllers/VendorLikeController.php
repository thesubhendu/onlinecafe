<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorLikeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth']);
    }

   

    public function store(Vendor $vendor, Request $request)
    {
        
        
        if ($vendor->likedBy($request->user())) {
            return response(null, 409);
        }
        $vendor->likes()->create([
            'user_id'=> $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Vendor $vendor, Request $request)
    {
        // dd($request->user(), $vendor->id);
        $request->user()->likes->where('vendor_id', $vendor->id)->each->delete();
        
        return back();
    }
}
