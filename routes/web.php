<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\RegisterController;

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
route::get('/vendor/{vendor}', 'App\http\Controllers\VendorController@show')->name('vendor.show');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::view('/menu', 'menu');
Route::view('/cart', 'cart');
Route::view('/vendor', 'vendor');
Route::view('/orders', 'orders');
Route::view('/comment', 'comment');
Route::view('/favourites', 'favourites');
Route::view('/order_submitted', 'order_submitted');
Route::view('/thankyou', 'thankyou');
Route::view('/cards', 'cards');

