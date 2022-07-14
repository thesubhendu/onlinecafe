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
        $card = Card::find($cardId);
        if($card && $card->loyalty_claimed === 0 && $card->is_max_stamped === 1 && $card->user_id === auth()->id())
        {
            return $card;
        }
        Cart::instance('manualClaimedProducts')->destroy();

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
        }
        $card->save();
    }

}
