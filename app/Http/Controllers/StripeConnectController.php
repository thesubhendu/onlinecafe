<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Services\StripeService;
use Illuminate\Http\Request;

class StripeConnectController extends Controller
{
    public function refreshUrl(Vendor $vendor)
    {
        return redirect()->to((new StripeService())->refreshUrl($vendor));
    }

    public function createAccount(Vendor $vendor)
    {
        $stripeConnectUrl = (new StripeService())->createAccount($vendor);
        return redirect()->to($stripeConnectUrl);
    }

}
