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
        $vendors = Vendor::with('ratings')->where('is_subscribed', '1')
            ->get();

        return view('landing-page', compact('vendors'));
    }
}
