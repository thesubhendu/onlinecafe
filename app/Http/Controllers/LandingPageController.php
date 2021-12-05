<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::where('is_subscribed', '1')
            ->get();

        $userLocation = geoip();

        if (empty($userLocation->lat)) {
            $userLocation = geoip('51.158.22.211'); //put some default location
        }
        $nearbyShops = (new Vendor())->nearbyShops($userLocation->lat, $userLocation->lon);

        return view('landing-page', compact('vendors', 'nearbyShops'));
    }
}
