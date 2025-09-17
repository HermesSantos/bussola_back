<?php

namespace App\Services;

use App\Http\Requests\CartRequest;

class CartService
{
    private const TEN_PERCENT_DISCOUNT = 0.1;
    private const ONE_PERCENT_DISCOUNT = 0.01;

    private $products;

    public function __construct() {
        $this->products = config('mock');
    }

    public function calculateTaxes (CartRequest $data) {

        $amount = $this->calculateAmount($data);

        if($data['metodo_pagamento'] == 'PIX') {
            return $this->pixPayment($amount);
        }

        if($data['metodo_pagamento'] == 'CARTAO_CREDITO') {
            $parcelas = $data['parcelas'];
            return $this->creditCardPayment($amount, $parcelas);
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
        $this->verifyRequest($data);
        
        $amount = 0;

        foreach ($data['produtos'] as $product) {
            $amount += $product['valor'] * $product['quantidade'];
        }

        return $amount;
    }
    private function verifyRequest ($data) {
        $mockProducts = collect(config('mock.products'))->keyBy('name');
        
        foreach($data['produtos'] as $item) {
            $sla = $mockProducts[$item['nome']] ?? null;

            if(!$sla) {
                throw new \Exception('Um ou mais produtos do carrinho não foram encontrados.');
            }

            if($sla['price'] != $item['valor']) {
                throw new \Exception('Valor(es) no produto ' . $item['nome'] . ' é(são) inválido(s).');
            }
        }
    }
}
