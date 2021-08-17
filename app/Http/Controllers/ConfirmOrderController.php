<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vendor;
use App\Mail\orderConfirmed;
use Illuminate\Http\Request;
use App\Events\VendorConfirmsOrder;
use Illuminate\Support\Facades\Mail;

class ConfirmOrderController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        if(! $request->hasValidSignature()) {
            abort(403);
        }

        Order::find($order);
        // $order->is_confirmed = 1;
        // $order->save();

        $order->orderConfirmed($order);

        $vendor = Vendor::find($order->vendor_id);

        return $order->vendor->vendor_name; $order->order_number;

        // return redirect()->action([VendorOrdersController::class, 'index'], $vendor);
        // return redirect()->action([VendorOrdersController::class, 'index'], $order);
    }
}
