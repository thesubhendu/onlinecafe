<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmed;
use App\Models\Order;
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
    public function confirm(Request $request, Order $order)
    {
        if ( ! $request->hasValidSignature()) {
            abort(403);
        }
        $order->confirm();
        //mail to customer
        Mail::to($order->user->email)->send(new OrderConfirmed($order));
        dd('order confirmed'); //todo where to redirect vendor?
    }
}
