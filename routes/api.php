<?php

use App\Http\Controllers\Api\{AuthController,
    CartController,
    ProductController,
    RewardController,
    UserController,
    VendorController};
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

    Route::get('get-active-order', [CartController::class, 'getActiveOrder']);
    Route::post('add-to-cart', [CartController::class, 'addToCart']);
    Route::put('update-cart-product/{orderProduct}', [CartController::class, 'updateCartProduct']);
    Route::delete('remove-from-cart/{orderProduct}', [CartController::class, 'removeFromCart']);

    Route::get('products/{product}', [ProductController::class, 'show']);

    Route::get('/rewards',[RewardController::class,'index']);

});
