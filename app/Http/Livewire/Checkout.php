<?php

namespace App\Http\Livewire;

use App\Mail\orderSubmitted;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Checkout extends Component
{
    public $user;
    public $cartItems;
    public $cartTotal;
    public $form = [];

    protected $rules = [
        'form.name' => 'required',
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

        $order = (new Order())->generate($this->cartItems, Cart::total());

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);
        //todo: ask if need to send to owner or vendor email
        Mail::to($order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));

//        \App\Events\OrderSubmitted::dispatch($order);
        $order->vendor->owner->notify(new NewOrderNotification($order));

        Cart::destroy();

        return redirect()->route('order.submitted', $order);
    }

}
