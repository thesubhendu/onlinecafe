<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    // public function index()
    // {
    //     $user = Auth()->user();
    //     $cartItems = Cart::content();

    //     return view('checkout')
    //         ->with('user', $user)
    //         ->with('cartItems', $cartItems);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'vendor_id' => 'required',
        ]);

        $order = new order;

        $order->order_number = uniqid();
        $order->order_total = Cart::total();
        $order->user_id = Auth()->id();
        $order->vendor_id = $request->input('vendor');

        dd($order);

        $order->save();

        dd('order created');
    }
}
