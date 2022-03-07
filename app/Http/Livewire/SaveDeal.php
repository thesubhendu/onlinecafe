<?php

namespace App\Http\Livewire;

use App\Models\Deal;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SaveDeal extends Component
{
    public $items;
    public $itemCount;
    public $subtotal;
    public $total;
    public $tax;

    public $qtyOptions;

    public $deal;

    public function mount(Deal $deal, $edit=null)
    {
        $this->deal = $deal;

        $this->refreshCart();

        $this->qtyOptions = [1, 2, 3, 4, 5, 6, 7, 8];
    }

    public function render()
    {
        return view('livewire.save-deal')->layout('layouts.app');
    }

    public function submit()
    {
        //authorize
        if(empty($this->items)) {
            session()->flash('message', 'Empty Cart');
            return back();
        }

        $deal = $this->deal->generate($this->items, $this->total);

        Cart::destroy();
        session()->remove('deal-'.$this->deal->vendor_id);

        return redirect()->route('platform.deal.list');
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
