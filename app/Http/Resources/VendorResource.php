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
            'id'                 => $this->id,
            'name'               => $this->name,
            'slug'               => $this->slug,
            'mobile'             => $this->mobile,
            'address'            => $this->address,
            'suburb'             => $this->suburb,
            'vendor_image'  => $this->vendor_image ? asset('storage/' . $this->vendor_image) : null,
            'state'              => $this->state,
            'pc'                 => $this->pc,
            'shop_name'          => $this->shop_name,
            'opening_hours'      => $this->opening_hours,
            'services'           => $this->services,
            'lat'                => $this->lat,
            'lng'                => $this->lng,
            'isFavorite'         => $this->isFavorite,
            'free_category_name' => $this->freeCategory->name ?? null,
            'ratings'       => $this->ratings,
            'is_open' => $this->is_open,
            'distance'      => $this->getDistanceFromCustomer(geoip()->getLocation()),
            'categoryProducts' => $this->products->groupBy('category.name'),
            'featuredProducts' => $this->products->take(8),
            'openingInfo'      => app()->make(VendorRepository::class)->getOpeningInfo($this),
            'categoryProducts' => $this->products->groupBy('category.name')
        ];
    }

    public function with($request): array
    {
        return [
            'message' => 'Vendor data retrieved successfully'
        ];
    }
}
