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
        $vendors = Vendor::inRandomOrder()->where('is_subscribed', '1')
                         ->get();
        return view('landing-page')
            ->with('vendors', $vendors);
    }
}
