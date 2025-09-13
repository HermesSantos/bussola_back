<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Hello World']);
});
Route::post('/calculate-cart-taxes', [CartController::class, 'calculateCartTaxes']);
