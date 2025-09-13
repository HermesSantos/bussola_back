<?php

namespace App\Services;


class CartService
{
    private const TEN_PERCENT_DISCOUNT = 0.1;
    private const ONE_PERCENT_DISCOUNT = 0.01;

    public function calculateTaxes (array $data) {

        $amount = $this->calculateAmount($data);

        if($data['metodo_pagamento'] == 'PIX') {
            return $this->pixPayment($amount);
        }

        if($data['metodo_pagamento'] == 'CARTAO_CREDITO') {
            return $this->creditCardPayment($amount, $data['parcelas']);
        }
    }

    private function pixPayment (int $amount) {
        return round($amount - self::TEN_PERCENT_DISCOUNT * $amount, 2);
    }

    private function creditCardPayment (int $amount, int $installments) {

        if($installments == 1) return round($amount - self::TEN_PERCENT_DISCOUNT * $amount, 2);

        return round($amount * pow((1 + self::ONE_PERCENT_DISCOUNT), $installments), 2);
    }

    private function calculateAmount (array $data) {
        $amount = 0;

        foreach ($data['produtos'] as $product) {
            $amount += $product['valor'] * $product['quantidade'];
        }

        return $amount;
    }
}
