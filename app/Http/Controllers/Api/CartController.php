<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Repositories\CartRepository;
use Illuminate\Http\JsonResponse;

class CartController extends ApiBaseController
{

    public function __construct(
        public CartRepository $cartRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse($this->cartRepository->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CartRequest  $request
     * @return JsonResponse
     */
    public function store(CartRequest $request): JsonResponse
    {
        $cartItem  = $this->cartRepository->addToCart($request->all());

        return $this->sendResponse($cartItem);
    }

    /**
     * @param  Cart  $cart
     * @return JsonResponse
     */
    public function destroy(Cart $cart): JsonResponse
    {
        return $this->sendResponse($this->cartRepository->removeFromCart($cart));
    }
}
