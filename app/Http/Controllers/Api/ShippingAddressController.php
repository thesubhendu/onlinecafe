<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ShippingAddressRequest;
use App\Http\Resources\ShippingAddressResource;
use App\Models\ShippingAddress;
use App\Repositories\ShippingAddressRepository;
use Illuminate\Http\JsonResponse;

class ShippingAddressController extends ApiBaseController
{
    public function __construct(
        public ShippingAddressRepository $shippingAddressRepository
    ) {
    }
    public function getUserShippingAddress(): ShippingAddressResource|JsonResponse
    {
        $shippingAddress = auth()->user()->shippingAddress;
        if(!$shippingAddress)
        {
            return $this->sendResponse(null, 'Empty shipping address');
        }

        return new ShippingAddressResource(auth()->user()->shippingAddress);
    }

    public function store(ShippingAddressRequest $request): ShippingAddressResource
    {
        return new ShippingAddressResource($this->shippingAddressRepository->add(auth()->user(), $request->all()));
    }

    public function update(ShippingAddressRequest $request, ShippingAddress $shippingAddress): ShippingAddressResource
    {
        return new ShippingAddressResource($this->shippingAddressRepository->update($shippingAddress, $request->all()));
    }
}
