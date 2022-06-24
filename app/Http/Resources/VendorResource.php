<?php

namespace App\Http\Resources;

use App\Repositories\VendorRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     * @throws BindingResolutionException
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'vendor'           => [
                'id'            => $this->id,
                'name'          => $this->vendor_name,
                'slug'          => $this->slug,
                'mobile'        => $this->mobile,
                'address'       => $this->address,
                'suburb'        => $this->suburb,
                'vendor_image'  => $this->vendor_image,
                'state'         => $this->state,
                'pc'            => $this->pc,
                'shop_name'     => $this->shop_name,
                'opening_hours' => $this->opening_hours,
                'services'      => $this->services,
                'lat'           => $this->lat,
                'lng'           => $this->lng,
                'isFavorite'    => $data->isFavorite,
            ],
            'ratings'          => $this->ratings,
            'featuredProducts' => $this->products->take(8),
            'openingInfo'      => app()->make(VendorRepository::class)->getOpeningInfo($this),
            'products'         => $this->products->groupBy('category.name')
        ];

    }

    public function with($request): array
    {
        return [
            'message' => 'Vendor data retrieved successfully'
        ];
    }
}
