<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VendorCollection;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Repositories\VendorRepository;

class VendorController extends ApiBaseController
{
    public function __construct(
        public VendorRepository $vendorRepository
    ) {
    }

    public function index(): VendorCollection
    {
        return new VendorCollection($this->vendorRepository->getAll());
    }

    public function show(Vendor $vendor): VendorResource
    {
        return new VendorResource($vendor->load('products', 'products.category'));
    }
}
