<?php

namespace App\Services;


class CartService
{
    public function calculateTaxes (array $data) {

        $amount = 0;
        foreach ($data['produtos'] as $product) {
            $amount += $product['valor'] * $product['quantidade'];
        }

        if($data['metodo_pagamento'] == 'PIX') {
            return $this->pixPayment($amount);
        }
        if($data['metodo_pagamento'] == 'CARTAO_CREDITO') {
            return $this->creditCardPayment($amount, $data['parcelas']);
        }
    }

    private function pixPayment (int $amount) {
        return round($amount - 0.1 * $amount, 2);
    }

    private function creditCardPayment (int $amount, int $installments) {

        if($installments == 1) return round($amount - 0.1 * $amount, 2);

        return round($amount * pow((1 + 0.01), $installments), 2);
    }
}
