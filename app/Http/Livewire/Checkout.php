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
    public $items;
    public $itemCount;
    public $subtotal;
    public $total;
    public $tax;

    public $user;

    public $qtyOptions;

    public function mount()
    {
        $this->refreshCart();
        $this->fill([
            'user'=> auth()->user(),
            'cartItems'=> Cart::content(),

        ]);
        $this->qtyOptions = [1, 2, 3, 4, 5, 6, 7, 8];
    }

    public function submit()
    {
        if(empty($this->items)) {
            session()->flash('message', 'Empty Cart');
            return back();
        }

        $order = (new Order())->generate($this->items, Cart::total());

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));

//        \App\Events\OrderSubmitted::dispatch($order);
        $order->vendor->owner->notify(new NewOrderNotification($order));

        Cart::destroy();

        return redirect()->route('order.submitted', $order);
    }

    public function hydrate()
    {
        $this->items = Cart::content();
    }
    private function refreshCart()
    {
        $this->items     = Cart::content();
        $this->subtotal  = Cart::subtotal();
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }

    public function updateQty($value, $rowId)
    {
        Cart::update($rowId, $value);
        $this->refreshCart();
    }

    public function removeItem($id)
    {
        Cart::remove($id);
        $this->refreshCart();

        session()->flash("message", "Item has been removed");
    }
}
