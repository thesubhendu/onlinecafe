<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\VendorLikeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\VendorRatingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartSaveForLaterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'landing-page');
// route::get('/', 'App\http\Controllers\LandingPageController@index')->name('landing-page');
route::get('/', [LandingPageController::class, 'index'])->name('home');
route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');
Route::get('/vendornew/{vendor}', [VendorController::class, 'vendorshow'])->name('vendor.newshow');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/vendor/{vendor}/likes', [VendorLikeController::class, 'store'])->name('vendor.likes');
Route::delete('/vendor/{vendor}/likes', [VendorLikeController::class, 'destroy'])->name('vendor.likes');

Route::post('/vendor/{vendor}/rate', [VendorRatingController::class, 'store'])->name('vendor.rating')->middleware('auth');

Route::get('/vendor/{vendor}/products', [ProductController::class, 'vendorproducts'])->name('vendor.products');


Route::get('/user/favourites', [FavouritesController::class, 'userlikes'])->name('user.likes');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/saveforlater/{product}', [CartController::class, 'saveItemForLater'])->name('cart.saveForLater');

Route::delete('/saveforlater/{product}', [CartSaveForLaterController::class, 'destroy'])->name('saveforlater.remove');
Route::post('/saveforlater/addtocart/{product}', [CartSaveForlaterController::class, 'moveToCart'])->name('saveforlaer.addtocart');

Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::resource('orders', OrderController::class)->names([
    'store' => 'order.store'
]);
// Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// Route::get('/orders/{vendor}', [OrderController::class, 'create'])->name('orders.create');
// Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/cards', [CardController::class, 'index'])->name('cards');


// Route::view('/order_submitted', 'order_submitted');
Route::view('/thankyou', 'thankyou');

Route::get('empty', function () {
    Cart::destroy();
});

Route::view('/comment', 'comment');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
