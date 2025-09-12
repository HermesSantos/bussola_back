<?php

use Illuminate\Support\Facades\Route;

Route::get('/oi', function () {
    return response()->json(['message' => 'Hello World']);
});
