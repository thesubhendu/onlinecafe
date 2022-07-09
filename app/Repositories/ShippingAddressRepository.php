<?php

namespace App\Repositories;

use App\Models\ShippingAddress;

class ShippingAddressRepository
{
    public function __construct(
        public ShippingAddress $shippingAddress
    ) {
    }

    public function add($user, $data)
    {
        return $user->shippingAddress()->create($data);
    }

    public function update($shippingAddress, $data)
    {
        return tap($shippingAddress)->update($data);
    }

}
