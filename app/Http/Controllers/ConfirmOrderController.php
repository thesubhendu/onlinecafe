<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vendor;
use App\Mail\orderConfirmed;
use Illuminate\Http\Request;
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

        Order::find($order);
        $order->is_confirmed = 1;
        $order->save();

        $vendor = Vendor::find($order->vendor_id);

        // dd($order, $vendor);

        Mail::to('coffeeshoporders0@gmail.com')->send(new orderConfirmed($order, $vendor));

        return view('thankyou')
            ->with('order', $order)
            ->with('vendor', $vendor)
            ->with('products');
    }
}
