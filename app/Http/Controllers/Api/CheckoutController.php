<?php

namespace App\Http\Controllers\Api;

use App\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;

class CheckoutController extends ApiBaseController
{
    public function __construct(
        public OrderRepository $orderRepository
    ) {

    }

    public function __invoke($type = null): JsonResponse
    {
        $updatedOrder = $this->orderRepository->submitOrder(auth()->id(), $type ? 'rewardClaim' : 'pending');
        return $this->sendResponse($updatedOrder);
    }
}
