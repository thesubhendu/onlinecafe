<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Mail\orderSubmitted;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class Checkout extends Component
{
    public $user;
    public $cartItems;
    public $cartTotal;
    public $form =[];

    protected $rules = [
        'form.name'=>'required',
        'form.email'=>'required',
        'form.mobile'=>'required',
    ];

    public function render()
    {
        return view('livewire.checkout');
    }

    public function hydrate()
    {
        $this->cartItems = Cart::content();
    }

    public function mount()
    {
        $this->fill([
            'user'=> auth()->user(),
            'cartItems'=> Cart::content(),
            'form'=> [
                'name'=> auth()->user()->name,
                'email'=> auth()->user()->email,
                'mobile'=> auth()->user()->mobile,
            ]
        ]);

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->cartTotal = [
            'total' => Cart::total(),
            'tax' => Cart::tax(),
            'subtotal' => Cart::subtotal(),
        ];
    }

    public function submit()
    {
        $this->validate();

        $vendor_id = $this->cartItems->first()->model->vendor_id;

        $order = new Order();
        $order->order_number = uniqid();
        $order->user_id      = auth()->id();
        $order->vendor_id    = $vendor_id;
        $order->order_total  = Cart::total();
        $order->save();

        foreach (Cart::content() as $product) {
            $order->products()->attach($product->id, [
                'price'    => $product->price,
                'quantity' => $product->qty,
                'options'=> json_encode($product->options)
            ]);
        }

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->email)
        ->send(new orderSubmitted($order, $confirm_url));

        Cart::destroy();

        // session()->flash('message', "Order Submitted");

        return redirect()->route('order.submitted', $order);
    }

}
