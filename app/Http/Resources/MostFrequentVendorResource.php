<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostFrequentVendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @throws Exception
     */
    public function toArray($request): array
    {
        $vendor = $this->vendor;

        return [
            'id'            => $vendor->id,
            'name'          => $vendor->name,
            'mobile'        => $vendor->mobile,
            'address'       => $vendor->address,
            'suburb'        => $vendor->suburb,
            'vendor_image'  => $vendor->vendor_image ? asset('storage/'.$vendor->vendor_image) : null,
            'shop_name'     => $vendor->shop_name,
            'services'      => $vendor->services,
            'isFavorite'    => $vendor->isFavorite,
            'distance'      => $vendor->getDistanceFromCustomer(geoip()->getLocation()),
            'total'         => $this->total
        ];
    }
}
