<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostOrderedProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'product_id'    => $this->product_id,
            'product_name'  => $this->product->name,
            'price'         => $this->product->price,
            'total_ordered' => $this->total,
            'vendor_id'     => $this->product->vendor_id,
            'category_id'   => $this->product->category_id,
            'category_name' => $this->product->category->name,
        ];
    }
}
