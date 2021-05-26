<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;


class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::inRandomOrder()
            ->take(3)
            ->get();
        return view('landing-page-new')
            ->with('vendors', $vendors);
    }
}
