<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\CartResource;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;

class ActiveOrderController extends ApiBaseController
{
    public function __construct(
        public CartService $cartService
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        return $this->sendResponse(
            new CartResource($this->cartService->getActiveOrder())
        );
    }

    public function destroy(Order $order)
    {
        return $this->sendResponse($order->delete());
    }
}
