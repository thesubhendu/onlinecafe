<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $order_product = Product::where('id', $id)
            ->get();
        return view('order')
            ->with('order_product', $order_product);
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
            'vendor' => 'required',
        ]);

        $user_id = auth()->id();
        $vendor_id = $request->input('vendor');

        $order = new Order();

        $order->order_number = uniqid();
        $order->user_id = $user_id;
        $order->vendor_id = $vendor_id;
        $order->order_total = Cart::total();

        $order->save();

        // save order products
        $cartProducts = Cart::content();
        foreach ($cartProducts as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' =>  $product->qty,
                'milk' => $product->model->milk,
                'sugar' => $product->model->sugar,
                'syrup' => $product->model->syrup
            ]);
        }

        // empty cart
        Cart::destroy();

        // email customer and vendor

        // redirect to order submitted page

        return "order completed, waiting for vendor to confirm";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
