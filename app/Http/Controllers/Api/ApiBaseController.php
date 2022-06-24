<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiBaseController extends Controller
{
    public function sendResponse($data, $message = "Response success", $code = 200): JsonResponse
    {
        return response()->json([
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    public function sendError($error, $code = 404): JsonResponse
    {
        return response()->json([
            'message' => $error,
        ], $code);
    }
}
