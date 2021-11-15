<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ]);

        Cart::add([
            'id'     => $request->id, 'name' => $request->name, 'qty' => $request->quantity, 'price' => $request->price,
            'weight' => '0', 'options' => [
                'milk'  => $request->milk,
                'sugar' => $request->sugar,
                'syrup' => $request->syrup,

            ],
        ])
            ->associate(Product::class);


        return redirect()->route('cart')
            ->with('product')
            ->with('success_message', 'Item added to your cart');
    }



}
