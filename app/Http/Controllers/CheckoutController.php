<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $cartItems = Cart::content();

        return view('checkout')
            ->with('user', $user)
            ->with('cartItems', $cartItems);
    }
}
