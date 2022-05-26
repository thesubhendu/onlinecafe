<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class DownloadFlyerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $filepath = public_path('assets/pdf/customer_flyer.pdf');
        return Response::download($filepath);
    }
}
