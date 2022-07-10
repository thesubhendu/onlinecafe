<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderProduct;
use Illuminate\Http\JsonResponse;

class OrderProductsController extends ApiBaseController
{
    public function index(): JsonResponse
    {
        $orderProducts = OrderProduct::whereIn('order_id', auth()->user()->orders()->pluck('id'))
            ->with('order', 'product')
            ->get();

        return $this->sendResponse($orderProducts);
    }
}
