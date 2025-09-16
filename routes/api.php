<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Api is working']);
});

Route::get('/get-products', [ProductsController::class, 'getProducts']);
Route::get('/get-product/{id}', [ProductsController::class, 'getProduct']);
Route::post('/calculate-cart-taxes', [CartController::class, 'calculateCartTaxes']);
