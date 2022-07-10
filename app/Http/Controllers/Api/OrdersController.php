<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends ApiBaseController
{
    public function show(Order $order): JsonResponse
    {
        return $this->sendResponse($order);
    }
}
