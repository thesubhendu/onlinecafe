<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserOrderProductCollection;
use App\Http\Resources\VendorCollection;
use App\Models\Vendor;
use App\Repositories\UserRepository;

class UserController extends ApiBaseController
{
    public function __construct(
        public UserRepository $userRepository
    ) {
    }

    public function favoriteVendors(): VendorCollection
    {
        return new VendorCollection(
            auth()->user()->favorite(Vendor::class)
        );
    }

    public function orderProducts(): UserOrderProductCollection
    {
        return new UserOrderProductCollection($this->userRepository->myOrderProducts());
    }
}
