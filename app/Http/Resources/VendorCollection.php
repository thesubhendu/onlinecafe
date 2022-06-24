<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class VendorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => [
                'vendors' => $this->collection->map(function ($data) {
                    return [
                        'id'            => $data->id,
                        'name'          => $data->vendor_name,
                        'slug'          => $data->slug,
                        'mobile'        => $data->mobile,
                        'address'       => $data->address,
                        'suburb'        => $data->suburb,
                        'vendor_image'  => $data->vendor_image,
                        'state'         => $data->state,
                        'pc'            => $data->pc,
                        'shop_name'     => $data->shop_name,
                        'opening_hours' => $data->opening_hours,
                        'services'      => $data->services,
                        'lat'           => $data->lat,
                        'lng'           => $data->lng,
                        'isFavorite'    => $data->isFavorite,
                        'ratings'       => $data->ratings,
                    ];
                })->values()
            ]
        ];
    }

    public function with($request): array
    {
        return [
            'message' => 'Vendors data retrieved successfully'
        ];
    }
}
