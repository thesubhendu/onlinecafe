<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class LoyaltyCheckout extends Component
{
    public $items;
    public $itemCount;
    public $card;

    public function render()
    {
        return view('livewire.loyalty-checkout')->layout('layouts.app');
    }

    public function mount(Card $card)
    {
        $this->card = $card;
        $this->items = Cart::instance('manualClaimedProducts')->content();
        $this->itemCount = count($this->items);
    }

    public function submit()
    {
        if (empty($this->items)) {
            session()->flash('message', 'Empty Cart');
            return back();
        }
        $rewardData = [
            'free_products_claimed' => Cart::instance('manualClaimedProducts')->content()->sum('qty'),
            'card_id'               => $this->card->id,
            'stamp_count'           => 0
        ];

        $order = (new Order())->generate(
            Cart::instance('manualClaimedProducts')->content(),
            Cart::instance('manualClaimedProducts')->total(),
            $rewardData
        );

        Cart::destroy();
        return redirect()->route('order.submitted', $order);
    }

    public function removeItem($id)
    {
        Cart::instance('manualClaimedProducts')->remove($id);
        $this->items = Cart::instance('manualClaimedProducts')->content();
        $this->itemCount = count($this->items);
        session()->flash("message", "Item has been removed");
    }

}
