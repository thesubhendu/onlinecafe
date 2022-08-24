<?php

use App\Http\Controllers\Api\{CustomerStripePaymentController,
    FrequentOrdersVendorsController,
    AuthController,
    CheckoutController,
    NotificationController,
    OrdersController,
    PayForwardController,
    ShippingAddressController,
    CartController,
    HomeController,
    ProductController,
    RewardController,
    StripeWebhookController,
    UserController,
    VendorController};
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

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

Route::post('/forgot-password',[ PasswordResetLinkController::class,'store']);
//Route::post('/reset-password',[ NewPasswordController::class,'store']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/home', HomeController::class);
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
    Route::delete('destroy-active-order', [CartController::class, 'destroyActiveOrder']);

    Route::get('products/{product}', [ProductController::class, 'show']);

    Route::get('/rewards', [RewardController::class, 'index']);
    Route::post('/pay-forward/{card}', [PayForwardController::class, 'sendGift']);
    Route::get('/pay-forward/{card}/accept', [PayForwardController::class, 'accept']);
    Route::get('/pay-forward/{card}/reject', [PayForwardController::class, 'reject']);

    // Manual Claim
    Route::get('/rewards/get-claimed-order', [RewardController::class, 'getClaimedOrder']);
    Route::post('/rewards/{card}/claim', [RewardController::class, 'claim'])
        ->middleware('can_claim_loyalty');
    Route::post('/rewards/add-product/{order}', [RewardController::class, 'addProduct']);
    Route::delete('/rewards/remove-product/{orderProduct}', [RewardController::class, 'removeProduct']);

    Route::get('get-user-shipping-address', [ShippingAddressController::class, 'getUserShippingAddress']);
    Route::apiResource('shipping-address', ShippingAddressController::class);

    Route::post('/checkout/{type?}', CheckoutController::class);
    Route::get('/orders/{order}', [OrdersController::class, 'show']);

    Route::get('customer-notifications/', [NotificationController::class, 'getCustomerNotifications']);
    Route::get('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);

    Route::get('user/{user}/frequent-orders-vendors', FrequentOrdersVendorsController::class);

    Route::post('vendor/{vendor}/rate', [VendorController::class, 'rate']);

    Route::post('payment',[CustomerStripePaymentController::class,'generatePaymentLink']);

});

//todo setup on stripe dash on production
Route::post('brewsta-stripe-whook', StripeWebhookController::class);
