<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Illuminate\Http\Request;

class StripeConnectController extends Controller
{
    public function refreshUrl()
    {
        $vendor = auth()->user()->shop;
        return redirect()->to((new StripeService())->refreshUrl($vendor->stripe_account_id));
    }

    public function returnUrl()
    {
        $vendor = auth()->user()->shop;
        return redirect()->route('vendor.show', $vendor);
    }
}
