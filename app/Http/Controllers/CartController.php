<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    public function calculateCartTaxes (CartRequest $request) {

        return response()->json(
            [
                "valor_total" => $this->cartService
                    ->calculateTaxes($request)
            ]
        );
    }
}
