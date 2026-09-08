<?php

use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/customer/table/{token}', [CustomerController::class, 'scanTableQr'])->name('customer.table.scan');
Route::post('/customer/table/set', [CustomerController::class, 'setTable'])->middleware('customer.auth')->name('customer.table.set');

Route::get('/customer/home', [CustomerController::class, 'home'])->middleware('customer.auth')->name('customer.home');
Route::get('/customer/menu/{menu}', [CustomerController::class, 'show'])->middleware('customer.auth')->name('customer.menu.show');
Route::get('/customer/profile', [CustomerController::class, 'profile'])->middleware('customer.auth')->name('customer.profile.index');
Route::get('/customer/order/history', [CustomerController::class, 'orderHistory'])->middleware('customer.auth')->name('customer.order.history');
Route::get('/customer/order/{order}', [CustomerController::class, 'showOrder'])->middleware('customer.auth')->name('customer.order.detail');
Route::get('/customer/order/{order}/status', [CustomerController::class, 'getOrderStatus'])->middleware('customer.auth')->name('customer.order.status');
Route::get('/customer/profile/password', [CustomerController::class, 'showChangePassword'])->middleware('customer.auth')->name('customer.password.edit');
Route::put('/customer/profile/password', [CustomerController::class, 'changePassword'])->middleware('customer.auth')->name('customer.password.update');
Route::get('/customer/profile/edit', [CustomerController::class, 'editProfile'])->middleware('customer.auth')->name('customer.profile.edit');
Route::put('/customer/profile', [CustomerController::class, 'updateProfile'])->middleware('customer.auth')->name('customer.profile.update');

Route::get('/customer/cart', [CustomerController::class, 'cartIndex'])->middleware('customer.auth')->name('customer.cart.index');
Route::post('/customer/cart', [CustomerController::class, 'addToCart'])->middleware('customer.auth')->name('customer.cart.add');
Route::post('/customer/cart/update', [CustomerController::class, 'cartUpdate'])->middleware('customer.auth')->name('customer.cart.update');
Route::get('/customer/checkout', [CustomerController::class, 'checkoutIndex'])->middleware('customer.auth')->name('customer.checkout');
Route::post('/customer/checkout', [CustomerController::class, 'checkoutStore'])->middleware('customer.auth')->name('customer.checkout.store');
Route::post('/customer/call-waiter', [CustomerController::class, 'callWaiter'])->middleware('customer.auth')->name('customer.call-waiter');
Route::get('/customer/call-waiter/status', [CustomerController::class, 'getCallWaiterStatus'])->middleware('customer.auth')->name('customer.call-waiter.status');

Route::middleware('customer.guest')->group(function () {
    Route::get('/', [CustomerController::class,'index'])->name('frontend.index');
    Route::get('customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.store');
    Route::get('customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
    Route::post('customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.store');

    Route::get('auth/google/redirect', [CustomerAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
    Route::get('auth/google/callback', [CustomerAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::middleware('customer.auth')->group(function () {
    Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});