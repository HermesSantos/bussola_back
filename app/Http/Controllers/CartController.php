<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function calculateCartTaxes (Request $request) {
        return response()->json($request);
    }
}
