<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoyaltyClaimService
{

    public function addClaimProductOnCart($card, $cartProduct): void
    {
        if ($this->remainingClaim($card)) {
            $cartProduct['price'] = 0;
            Cart::instance('manualClaimedProducts')->add($cartProduct)->associate(Product::class);
        }
    }

    public function verifiedLoyaltyCard($cardId): ?Card
    {
        $claimCard = Card::find($cardId);
        if ($claimCard && session()->get('claimCardId') === $claimCard->id) {
            return $claimCard;
        }
        Cart::destroy();

        return null;
    }

    public function remainingClaim($card): int
    {
        return ($card->vendor->get_free - $card->total_claimed) - $this->totalProductClaimedOnCart();
    }

    public function totalProductClaimedOnCart(): int
    {
        return Cart::instance('manualClaimedProducts')->content()->sum('qty');
    }

    public function updateLoyaltyCardOnCheckout($cardId): void
    {
        $card = Card::find($cardId);
        $card->total_claimed += $this->totalProductClaimedOnCart();
        if($card->total_claimed === $card->vendor->get_free)
        {
            $card->loyalty_claimed = 1;
            $card->is_active = 0;
        }
        $card->save();
    }

}
