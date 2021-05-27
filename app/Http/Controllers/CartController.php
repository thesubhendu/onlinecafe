<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::add($request->id, $request->name, 1, $request->price, array $options = ([
            $request->ordermilk,
            $request->ordersugar, 
            $request->ordersyrup
        ])
            ->associate(Product::class);

        return redirect()->route('cart')
            ->with('product')
            ->with('success_message', 'Item added to your cart');

        // , $request->ordermilk, $request->ordersugar, $request->ordersyrup
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
     * Remove the selected item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = Cart::get($id);

        Cart::remove($item);

        return back()->with('success_message', 'Item has been removed from your cart');
    }

    //  /**
    //  * Remove the selected item from the cart.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function removeFromCart($id)
    // {

    //     Cart::remove($id);

    //     return back()->with('success_message', 'Item has been removed from your cart');
    // }

    /**
     * move to save for later.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveItemForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);

        return back()->with('success_message', 'Item has been moved to save for later');
    }
}
