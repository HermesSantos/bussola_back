<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    public function calculateCartTaxes (Request $request) {
        $data = $request->validate([
            'produtos' => 'required|array',
            'produtos.*.nome' => 'required|string',
            'produtos.*.valor' => 'required|numeric',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'metodo_pagamento' => 'required|string',
            'parcelas' => 'nullable|integer|min:1'
        ]);
        return response()->json(
            [
                "valor_total" => $this->cartService->calculateTaxes($data)
            ]
        );
    }
}
