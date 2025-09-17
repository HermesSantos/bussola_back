<?php

namespace Tests\Feature;

use Tests\TestCase;

class CartControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_pix_payment_tax(): void
    {

        $payload = [
            "produtos" => [
                ["nome" => "Fone de Ouvido", "valor" => 100.00, "quantidade" => 2],
                ["nome" => "Mouse Gamer", "valor" => 150.00, "quantidade" => 1]
            ],
            "metodo_pagamento" => "PIX",
            "parcelas" => 1
        ];

        $response = $this->post('api/calculate-cart-taxes', $payload);

        $response
            ->assertJson([
                "valor_total" => 315.00
            ])
            ->assertStatus(200);
    }

    public function test_credit_card_tax_payment_with_one_installment(): void
    {

        $payload = [
            "produtos" => [
                ["nome" => "Fone de Ouvido", "valor" => 100.00, "quantidade" => 2],
                ["nome" => "Mouse Gamer", "valor" => 150.00, "quantidade" => 1]
            ],
            "metodo_pagamento" => "CARTAO_CREDITO",
            "parcelas" => 1
        ];

        $response = $this->post('api/calculate-cart-taxes', $payload);

        $response
            ->assertJson([
                "valor_total" => 315.00
            ])
            ->assertStatus(200);
    }

    public function test_credit_card_tax_payment_with_more_than_one_installment(): void
    {

        $payload = [
            "produtos" => [
                ["nome" => "Fone de Ouvido", "valor" => 100.00, "quantidade" => 2],
                ["nome" => "Mouse Gamer", "valor" => 150.00, "quantidade" => 1]
            ],
            "metodo_pagamento" => "CARTAO_CREDITO",
            "parcelas" => 3
        ];

        $response = $this->post('api/calculate-cart-taxes', $payload);

        $response
            ->assertJson([
                "valor_total" => 360.61
            ])
            ->assertStatus(200);
    }

    public function test_payload_data_is_wrong (): void {
        $payload = [
            "produtos" => [
                [ "nome" => "Fone de Ouvido", "valor" => 10000000.00, "quantidade" => 2 ],
                [ "nome" => "Mouse Gamer", "valor" => 150.00, "quantidade" => 1 ]
            ],
            "metodo_pagamento" => "CARTAO_CREDITO",
            "parcelas" => 3
        ];

        $response = $this->post('api/calculate-cart-taxes', $payload);

        $response
            ->assertStatus(500);

    }
}
