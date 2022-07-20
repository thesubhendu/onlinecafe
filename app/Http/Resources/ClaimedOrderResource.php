<?php

namespace App\Http\Resources;

use App\Services\LoyaltyClaimService;
use App\Services\RewardClaimService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimedOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        if (!$this->resource) {
            return [
                'order'          => null,
                'order_products' => [],
                'card'           => null,
            ];
        }
        $order = [
            'id'                    => $this->id,
            "user_id"               => $this->user_id,
            "vendor_id"             => $this->vendor_id,
            "order_total"           => $this->order_total,
            "sub_total"             => $this->sub_total,
            "tax"                   => $this->tax,
            "status"                => $this->status,
            "free_products_claimed" => $this->free_products_claimed,
            "card_id"               => $this->card_id,
            "stamp_count"           => $this->stamp_count
        ];

        $orderProducts = $this->products->map(function ($product) {
            return [
                'id'          => $product->pivot->id,
                'order_id'    => $product->pivot->order_id,
                'product_id'  => $product->id,
                "name"        => $product->name,
                "category_id" => $product->category_id,
                'price'       => $product->pivot->price,
                'quantity'    => $product->pivot->quantity,
                'options'     => json_decode($product->pivot->options),
            ];
        });
        $card = $this->card;
        $card['remaining_claim'] = (new RewardClaimService())->remainingClaimProductCount($this->resource);

        return [
            'order'          => $order,
            'order_products' => $orderProducts,
            'card'           => $card
        ];
    }
}
