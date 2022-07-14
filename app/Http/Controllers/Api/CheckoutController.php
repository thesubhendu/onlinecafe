<?php

namespace App\Http\Controllers\Api;

use App\Repositories\OrderRepository;

class CheckoutController extends ApiBaseController
{
    public function __construct(
        public OrderRepository $orderRepository
    ) {

    }

    public function __invoke($type = null)
    {
        $updatedOrder = $this->orderRepository->submitOrder($type ? 'rewardClaim' : 'pending');
        $this->sendResponse($updatedOrder);
    }
}
