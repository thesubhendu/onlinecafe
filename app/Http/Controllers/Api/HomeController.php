<?php

namespace App\Http\Controllers\Api;

use App\Models\Vendor;
use App\Http\Resources\HomeCollection;
use App\Http\Resources\VendorCardResource;
use Illuminate\Http\Request;

class HomeController
{

    public function __invoke(Request $request)
    {
        return new HomeCollection([
            'nearBy'=> VendorCardResource::collection(Vendor::subscribed()->active()->nearBy(getCustomerLocation())->take(5)->get()),
            'all'=> VendorCardResource::collection(Vendor::subscribed()->active()->get()),
            'newest'=> VendorCardResource::collection(Vendor::subscribed()->active()->orderBy('created_at','desc')->take(5)->get()),
        ]);
    }


}
