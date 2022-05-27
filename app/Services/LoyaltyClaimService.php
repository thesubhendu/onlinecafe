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
            Cart::add($cartProduct)->associate(Product::class);
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
        $totalClaimed = 0;
        foreach (Cart::content() as $row) {
            if ($row->price == 0) {
                $totalClaimed += $row->qty;
            }
        }
        return $totalClaimed;
    }

    public function updateLoyaltyCardOnCheckout($loyaltyCard): void
    {
        $loyaltyCard->total_claimed += $this->totalProductClaimedOnCart();
        if($loyaltyCard->total_claimed === $loyaltyCard->vendor->get_free)
        {
            $loyaltyCard->loyalty_claimed = 1;
            $loyaltyCard->is_active = 0;
        }
        $loyaltyCard->save();
    }

}
