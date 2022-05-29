<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoyalityCard extends Component
{

    public $cards;

    public $showPayForwardForm = [];

    protected $listeners = ['giftTransferred'];

    public function mount()
    {
        $this->cards = $this->fetchCards();

        foreach ($this->cards as $card) {
            $this->showPayForwardForm[$card->id] = false;
        }
    }

    public function fetchCards()
    {
        $user = auth()->user();

        return Card::query()->with('vendor', 'stamps')
            ->where(['user_id' => $user->id, 'receiver_email' => null])
            ->orWhere('receiver_email', $user->email)
            ->get();
    }

    public function togglePayForwardForm($cardId)
    {
        $this->showPayForwardForm[$cardId] = ! $this->showPayForwardForm[$cardId];
    }

    public function render()
    {
        return view('livewire.loyality-card');
    }

    public function giftTransferred($card)
    {
        $this->cards = $this->fetchCards();
    }

    public function onClaim($card)
    {
        Cart::destroy();
        session()->put('claimCardId', $card['id']);
        return redirect()->route('claim-loyalty-products', ['card' => $card['id']]);
    }

}
