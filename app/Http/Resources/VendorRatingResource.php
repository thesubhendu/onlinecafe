<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class VendorRatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'comment'     => $this->comment,
            'author_name' => $this->author->name,
            'rating'      => $this->rating,
            'user_id'     => $this->user_id,
            'vendor_id'   => $this->vendor_id,
            'date'        => $this->updated_at->diffForHumans(),
        ];
    }
}
