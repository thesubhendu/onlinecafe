<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MostFrequentVendorResource;
use App\Http\Resources\MostOrderedProductsResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class FrequentOrdersVendorsController extends ApiBaseController
{
    public function __construct(
        public UserRepository $userRepository
    ) {

    }
    public function __invoke(User $user): JsonResponse
    {
        return $this->sendResponse([
            'most_ordered_products' => MostOrderedProductsResource::collection(
                $this->userRepository->mostOrderedProducts($user->id)
            ),
            'most_frequent_vendors' => MostFrequentVendorResource::collection(
                $this->userRepository->mostFrequentVendors($user->id)
            ),
        ]);
    }
}
