<?php

namespace App\Http\Controllers;

use App\Mail\orderSubmitted;
use App\Models\Card;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stamp;
use App\Models\Vendor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
        $product     = Product::where('id', $id)
                              ->first();
        $milkOptions = ['Cream', 'Skimmed', 'cow milk'];

        $sugar = ['', 1, 2, 3, 4, 5];
        $syrup = ['', 1, 2, 3, 4, 5];

        return view('order')
            ->with([
                'product'     => $product,
                'milkOptions' => $milkOptions,
                'sugar'       => $sugar,
                'syrup'       => $syrup,
            ]);
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


        $user        = $request->user();
        $vendor_id   = $request->input('vendor');
        $active_card = Card::activeCard($vendor_id);
        $vendor      = Vendor::find($vendor_id);

        if ($active_card) {
            $order = new Order();

            $order->order_number = uniqid();
            $order->user_id      = auth()->id();
            $order->vendor_id    = $vendor_id;
            $order->order_total  = Cart::total();

            $order->save();

            $cart_items = Cart::content();

            foreach ($cart_items as $product) {
                $order->products()->attach($product->id, [
                    'price'    => $product->price,
                    'quantity' => $product->qty,
                    'milk'     => $product->options->milk,
                    'sugar'    => $product->options->sugar,
                    'syrup'    => $product->options->syrup
                ]);
            }

            //get stamps and check count
            $card_stamp   = Stamp::where('card_id', $active_card->id);
            $numberStamps = $product->qty;

            // if less than max stamps stamp card
            if ($card_stamp->count() < $active_card->maxStamps) {
                for ($i = 0; $i < $numberStamps; $i++) {

                    $stamp            = new Stamp;
                    $stamp->card_id   = $active_card->id;
                    $stamp->order_id  = $order->id;
                    $stamp->user_id   = auth()->id();
                    $stamp->vendor_id = $vendor_id;
                    $stamp->order_id  = $order->id;

                    $stamp->save();
                }
            }
        } else {

            $new_card            = new card;
            $new_card->user_id   = auth()->id();
            $new_card->vendor_id = $vendor_id;
            $new_card->maxStamps = 10; // need to get vendor maxstamps/cardstamps from model
            $new_card->is_active = true;


            $new_card->save();


            $order = new Order();

            $order->order_number = uniqid();
            $order->user_id      = auth()->id();
            $order->vendor_id    = $vendor_id;
            $order->order_total  = Cart::total();

            $order->save();
            $cart_items = Cart::content();

            foreach ($cart_items as $product) {
                $order->products()->attach($product->id, [
                    'price'    => $product->price,
                    'quantity' => $product->qty,
                    'milk'     => $product->options->milk,
                    'sugar'    => $product->options->sugar,
                    'syrup'    => $product->options->syrup

                ]);
            }
            $numberStamps = $product->qty;
            for ($i = 0; $i < $numberStamps; $i++) {

                $stamp            = new Stamp;
                $stamp->card_id   = $new_card->id;
                $stamp->order_id  = $order->id;
                $stamp->user_id   = auth()->id();
                $stamp->vendor_id = $vendor_id;
                $stamp->order_id  = $order->id;

                $stamp->save();
            }
        }

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        // email customer and vendor
        // Mail::to($order->vendor->email)->send(new orderSubmitted($order));
        Mail::to('coffeeshoporders0@gmail.com')
            ->send(new orderSubmitted($order, $confirm_url));

        // empty cart
        Cart::destroy();

        return redirect()->route('order.submitted', $order);
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
