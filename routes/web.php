<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductsController;
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

Route::get('products', [ProductsController::class, 'index'])
    ->name('products');
Route::get('products/{id}', [ProductsController::class, 'update'])
    ->name('products.update');

Route::get('basket', [BasketController::class, 'index'])
    ->name('basket');
Route::get('basket/store', [BasketController::class, 'store'])
    ->name('basket.store');

Route::delete('basket/{id}', [BasketController::class, 'destroy'])
    ->name('basket.destroy');
Route::delete('basket', [BasketController::class, 'destroyAll'])
    ->name('basket.destroyAll');