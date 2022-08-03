<?php

namespace App\Http\Resources;

use App\Repositories\VendorRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class VendorCardResource extends JsonResource
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
            'id'                  => $this->id,
            'name'                => $this->name,
            'slug'                => $this->slug,
            'mobile'              => $this->mobile,
            'address'             => $this->address,
            'suburb'              => $this->suburb,
            'vendor_image'        => $this->vendor_image ? asset('storage/'.$this->vendor_image) : null,
            'state'               => $this->state,
            'pc'                  => $this->pc,
            'opening_hours'       => $this->opening_hours,
            'services'            => $this->services,
            'isFavorite'          => $this->isFavorite,
            'free_category_name'  => $this->freeCategory->name ?? null,
            'average_rating'      => $this->rating(),
            'is_open'             => $this->is_open,
            'distance'            => $this->getDistanceFromCustomer(geoip()->getLocation()),
        ];
    }

    public function with($request): array
    {
        return [
            'message' => 'Vendor data retrieved successfully',
        ];
    }
}
