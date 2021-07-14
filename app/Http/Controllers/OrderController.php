<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Stamp;
use App\Models\Product;
use App\Mail\orderSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('orders')
            ->with('user', $user->orders)
            ->with('products');
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


        // get active card for vendor and user check if card is active cardStatus($vendor) user auth->id() in the model to get the user id
        // $active_card = new Card;
        // $active_card->getCard($vendor_id);

        $active_card = Card::where('user_id', $user_id)
            ->where('vendor_id', $vendor_id)
            ->where('is_active', true)->get()->toArray();

        if ($active_card) {
            $active_card = collect([$active_card]);
            dd($active_card);
        } else {

            dd('no card');
            $new_card = new card;
            $new_card->user_id = $user_id;
            $new_card->vendor_id = $vendor_id;
            $new_card->maxStamps = 10;
            $new_card->is_active = true;

            $new_card->save();

            $active_card = $new_card->id;
        }



        // dd($active_card);



        $order = new Order();

        $order->order_number = uniqid();
        $order->user_id = $user_id;
        $order->vendor_id = $vendor_id;
        $order->order_total = Cart::total();

        $order->save();

        // save order products

        foreach (Cart::content() as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty,
                'milk' => $product->model->milk,
                'sugar' => $product->model->sugar,
                'syrup' => $product->model->syrup
            ]);
        }

        // get active card for vendor and user check if card is active cardStatus($vendor) user auth->id() in the model to get the user id
        // $card_id = Card::getCard($vendor_id);

        // dd($card_id);

        // $card = Card::where('user_id', $user_id)
        //     ->where('vendor_id', $vendor_id)
        //     ->where('is_active', true)->get();

        // dd($card);

        // if active check number of stamps on card

        // if less than max stamps stamp card

        // else create new card and stamp
        // $card->stamp->create() something like this??


        // create new cardcard
        $card = new card;
        $card->user_id = $user_id;
        $card->vendor_id = $vendor_id;
        $card->maxStamps = 10;
        $card->is_active = true;

        $card->save();



        // check maxStamps
        // check number of stamps on card
        // create or stamp card

        // Stamp::stampCard('id');

        $stamp = new Stamp;
        $stamp->card_id = $card->id;
        $stamp->order_id = $order->id;
        $stamp->user_id = $user_id;
        $stamp->vendor_id = $vendor_id;

        $stamp->save();

        // email customer and vendor
        // Mail::to($order->vendor->email)->send(new orderSubmitted($order));
        Mail::to('coffeeshoporders0@gmail.com')->send(new orderSubmitted($order));

        // empty cart
        Cart::destroy();

        // redirect to order submitted page

        return view('order_submitted')
            ->with('order', $order->products);
        // ->with('orderProducts', $orderProducts);
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
