<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Deal;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function addToCart(CartRequest $request, Product $product): JsonResponse
    {
        $cartItem = $this->cartService->addToCart($product, $request->get('quantity'), $request->get('options'));
        return $this->sendResponse(
            new CartResource($cartItem->load('products'))
        );
    }

    public function addDealToCart(Deal $deal)
    {
        $this->cartService->addDealToCart($deal);
        return $this->sendResponse([

        ]);
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

    public function destroyActiveOrder(): JsonResponse
    {
        return $this->sendResponse( $this->cartService->destroy());
    }
}
