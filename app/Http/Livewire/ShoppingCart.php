<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $items;
    public $itemCount;
    public $subtotal;
    public $total;
    public $tax;

    public $qtyOptions;

    public function mount()
    {
        $this->refreshCart();

        $this->qtyOptions = [1, 2, 3, 4, 5, 6, 7, 8];


    }

    private function refreshCart()
    {
        $this->items     = Cart::content()->toArray();
        $this->subtotal  = Cart::subtotal();
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
    }

    public function render()
    {
        return view('livewire.shopping-cart')->layout('layouts.app');
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
