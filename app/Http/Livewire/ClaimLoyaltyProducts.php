<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Services\LoyaltyClaimService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ClaimLoyaltyProducts extends Component
{
    public $vendor;
    public $card;
    public $claimItems;
    public $remainingClaim;

    public function render()
    {
        return view('livewire.claim-loyalty-products');
    }

    public function mount(Card $card, LoyaltyClaimService $loyaltyClaimService)
    {
        $this->card = $card;
        $this->vendor = $card->vendor;
        $this->claimItems = Cart::instance('manualClaimedProducts')->content();
        $this->remainingClaim = $loyaltyClaimService->remainingClaim($card);
    }

    public function removeItem($id)
    {
        Cart::instance('manualClaimedProducts')->remove($id);
        $this->claimItems = Cart::instance('manualClaimedProducts')->content();
        $this->remainingClaim = (new LoyaltyClaimService())->remainingClaim($this->card);
        session()->flash("message", "Item has been removed");
    }
}
