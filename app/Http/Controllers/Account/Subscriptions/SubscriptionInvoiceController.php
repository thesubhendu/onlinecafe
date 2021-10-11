<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request) {

        $invoices = $request->user()->invoices();
        return view('account.subscriptions.invoice', compact('invoices')); // or ->with('invoices);
    }

    public function show(Request $request, $id) {

        // stripe invoice pdf
        // easier to customise
        // return redirect($request->user()->findInvoice($id)->asStripeInvoice()->invoice_pdf);

        return $request->user()->downloadInvoice($id, [
            'vendor' => config('app.name'),
            "product" => 'Membership'
        ]);
    }
}
