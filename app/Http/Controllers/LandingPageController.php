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

        return redirect()->route('vendor-landing');
        $vendors = Vendor::with('ratings')
            ->subscribed()
            ->get();

    }
}
