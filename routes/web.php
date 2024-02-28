<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Order_itemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])
        ->middleware('guest')
        ->name('register');
    Route::post('register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('login', [LoginController::class, 'store'])
        ->name('login.store');
});


Route::middleware('auth')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])
        ->name('login.logout');

    Route::get('products', [ProductController::class, 'index'])
        ->name('products');

    Route::get('products/{id}', [ProductController::class, 'show'])
        ->name('products.show');
    Route::put('products/{id}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::get('basket', [BasketController::class, 'index'])
        ->name('basket');
    Route::get('basket/store', [BasketController::class, 'store'])
        ->name('basket.store');

    Route::delete('basket/{id}', [BasketController::class, 'destroy'])
        ->name('basket.destroy');
    Route::delete('basket', [BasketController::class, 'destroyAll'])
        ->name('basket.destroyAll');

    Route::get('order', [OrderController::class, 'index'])
        ->name('order');

    Route::get('order/store', [OrderController::class, 'store'])
        ->name('order.store');

    Route::get('order/{id}', [OrderController::class, 'show'])
        ->name('order.show');
});

Route::middleware('admin')->group(function () {
    Route::get('adminPanel', [AdminPanelController::class, 'index'])
        ->name('adminPanel');
    Route::post('adminPanel', [AdminPanelController::class, 'create'])
        ->name('admin-panel.create');
    Route::post('adminPanel/store', [AdminPanelController::class, 'store'])
        ->name('admin-panel.store');

    Route::get('adminPanel/{id}', [AdminPanelController::class, 'edit'])
        ->name('admin-panel.edit');
    Route::put('adminPanel/{id}', [AdminPanelController::class, 'update'])
        ->name('admin-panel.update');

    Route::delete('adminPanel/{id}', [AdminPanelController::class, 'destroy'])
        ->name('admin-panel.destroy');
});
