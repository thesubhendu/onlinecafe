<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VendorCollection;
use App\Http\Resources\VendorRatingResource;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        return new VendorResource($vendor->load([
            'activeProducts', 'activeProducts.category', 'ratings.author' => function ($query) {
                return $query->select(['id', 'name']);
            },
        ]));
    }

    public function toggleFavorite(Vendor $vendor): JsonResponse
    {
        $vendor->toggleFavorite();
        $favorite = $vendor->isFavorited();

        return $this->sendResponse(
            ['favorite' => $favorite],
            $favorite ? 'Vendor Saved' : 'Vendor Removed'
        );

    }



}
