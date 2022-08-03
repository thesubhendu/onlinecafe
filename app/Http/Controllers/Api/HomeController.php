<?php

namespace App\Http\Controllers\Api;

use App\Models\Vendor;
use App\Http\Resources\HomeCollection;
use App\Http\Resources\VendorCardResource;

class HomeController
{

    public function __invoke()
    {
        return new HomeCollection([
            'nearBy'=> VendorCardResource::collection(Vendor::subscribed()->nearBy(geoip()->getLocation())->take(5)->get()),
            'topRated'=> VendorCardResource::collection(Vendor::subscribed()->topRated()->take(5)->get()),
            'popular'=> VendorCardResource::collection(Vendor::subscribed()->popular()->take(5)->get()),
        ]);
    }


}
