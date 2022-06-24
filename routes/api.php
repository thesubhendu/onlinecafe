<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Vendor
    Route::get('vendors', [VendorController::class, 'index']);
    Route::get('vendors/{vendor}', [VendorController::class, 'show']);
    // Favorite Vendor
    Route::get('user/favourite-vendors', [UserController::class, 'favoriteVendors']);
    // Toggle Favorite Vendor
    Route::get('vendors/{vendor}/toggle-favourite', [VendorController::class, 'toggleFavorite']);
    // User Order Products
    Route::get('user/order-products', [UserController::class, 'orderProducts']);
});

//
