<?php

namespace App\Services;

use App\Http\Requests\CartRequest;

class CartService
{
    private const TEN_PERCENT_DISCOUNT = 0.1;
    private const ONE_PERCENT_DISCOUNT = 0.01;

    public function calculateTaxes (CartRequest $data) {

        $amount = $this->calculateAmount($data);

        if($data['metodo_pagamento'] == 'PIX') {
            return $this->pixPayment($amount);
        }

        if($data['metodo_pagamento'] == 'CARTAO_CREDITO') {
            return $this->creditCardPayment($amount, $data['parcelas']);
        }
    }

    private function pixPayment (float $amount) {
        return round($amount - self::TEN_PERCENT_DISCOUNT * $amount, 2);
    }

    private function creditCardPayment (float $amount, int $installments) {

        if($installments == 1) return round($amount - self::TEN_PERCENT_DISCOUNT * $amount, 2);

        return round($amount * pow((1 + self::ONE_PERCENT_DISCOUNT), $installments), 2);
    }

    private function calculateAmount (CartRequest $data) {
        $amount = 0;

        foreach ($data['produtos'] as $product) {
            $amount += $product['valor'] * $product['quantidade'];
        }

        return $amount;
    }
}
