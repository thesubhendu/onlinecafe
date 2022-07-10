<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Repositories\OrderRepository;

class CheckoutController extends ApiBaseController
{
    public function __construct(
        public OrderRepository $orderRepository
    ) {

    }

    public function __invoke()
    {
        $updatedOrder = $this->orderRepository->submitPendingOrder();
        $this->sendResponse($updatedOrder);
    }
}
