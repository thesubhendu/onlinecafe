<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class FavouritesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('favourites', [
            'userlikes' => auth()->user()->favorite(Vendor::class),
        ]);

    }

}
