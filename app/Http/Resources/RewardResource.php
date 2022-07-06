<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RewardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'reward_card_id'=> $this->id,
            'is_loyalty_claimed' => $this->loyalty_claimed,
            'vendor_id' => $this->vendor_id,
            'card_logo'=> $this->card_logo,
            'shop_name'=> $this->vendor->shop_name ?? $this->vendor->vendor_name,
            'max_stamps'=> $this->vendor->max_stamps ?? 10,
            'is_max_stamped'=> $this->is_max_stamped,
            'get_free'=> $this->vendor->get_free,
            'free_category'=> $this->vendor->freeCategory->name,
            'total_claimed'=> $this->total_claimed,
            'remaining_claim'=> $this->vendor->get_free - $this->total_claimed,
            'stamp_count'=> $this->stamps->count(),
            'updated_at'=> $this->updated_at->diffForHumans(),
        ];
    }
}
