<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
        if (!$request->hasValidSignature()) {
            abort(403);
        }
        if ($order->confirmed_at) {
            return redirect()->route('platform.order.show', $order);
        }
        $order->confirm();

        return redirect()->route('platform.order.show', $order);
    }
}
