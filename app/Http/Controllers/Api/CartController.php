<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\OrderProduct;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends ApiBaseController
{

    public function __construct(
        public CartService $cartService
    ) {
    }

    public function getActiveOrder(): JsonResponse
    {
        return $this->sendResponse(
            new CartResource($this->cartService->getActiveOrder())
        );
    }

    public function addToCart(CartRequest $request): JsonResponse
    {
        $cartItem = $this->cartService->addToCart($request->all());

        return $this->sendResponse(
            new CartResource($cartItem->load('products'))
        );
    }

    public function updateCartProduct(Request $request, OrderProduct $orderProduct): JsonResponse
    {
        $cartItem = $this->cartService->update($orderProduct, $request->all());

        return $this->sendResponse(
            new CartResource($cartItem->load('products'))
        );
    }

    public function removeFromCart(OrderProduct $orderProduct): JsonResponse
    {
        return $this->sendResponse(new CartResource(
                $this->cartService->remove($orderProduct)->load('products'))
        );
    }
}
