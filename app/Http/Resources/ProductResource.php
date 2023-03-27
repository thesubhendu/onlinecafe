<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $optionTypes =$this->optionTypes();

        return array_merge(
            parent::toArray($request),
            [
                'product_prices'=> $this->productPrices->where('price','!=','0.00')->all(),
                'option_types' => $optionTypes,
                'updated_price' => $this->getProductPrice($this, $optionTypes),
                'vendor_product_options' => $this->vendor->productOptions()->with('optionType')->get()
            ]
        );
    }

    private function getProductPrice($product, $optionTypes): int
    {
        $price = 0;
        if($product->productPrices->count()){
            $price = $product->productPrices()->where('size', 'S')->first()->price ?? $this->product->price;
        }

        $price += $product->vendor
            ->productOptions()
        ->where('default_option', true)
        ->sum('price');

        return $price;
    }
}
