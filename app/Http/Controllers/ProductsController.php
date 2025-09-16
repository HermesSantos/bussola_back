<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $products = [
        'products' => [
            [
                'id' => 1,
                'name' => 'Fone de Ouvido',
                'price' => 100,
                'quantity' => 2,
                'description' => 'Fone com ótima qualidade de som.',
                'image_url' => 'https://pichaugaming.com.br/wp-content/uploads/2022/11/2019-10-03-15-19-45-BRadius8Smoothing4-1024x1024.png'
            ],
            [
                'id' => 2,
                'name' => 'Mouse Gamer',
                'price' => 150,
                'quantity' => 1,
                'description' => 'Mouse gamer com DPI ajustável e iluminação RGB.',
                'image_url' => 'https://drivers.pichau.com.br/pichaugaming/Banner/PCH-SSB-BLK.png'
            ],
            [
                'id' => 3,
                'name' => 'Teclado Mecânico',
                'price' => 250,
                'quantity' => 1,
                'description' => 'Teclado mecânico com switches táteis e retroiluminação.',
                'image_url' => 'https://pichaugaming.com.br/wp-content/uploads/2022/11/PGK-P421-RGB-300x300.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Monitor 24"',
                'price' => 900,
                'quantity' => 1,
                'description' => 'Monitor Full HD 24 polegadas com alta taxa de atualização.',
                'image_url' => 'https://drivers.pichau.com.br/pichaugaming/Banner/PC-PRS27-V2.png'
            ],
            [
                'id' => 5,
                'name' => 'Mesa Altura Regulável',
                'price' => 300,
                'quantity' => 1,
                'description' => 'Mesa retrátil.',
                'image_url' => 'https://pichaugaming.com.br/wp-content/uploads/2024/08/pg-sts120-bk3-300x300.jpg'
            ],
        ]
    ];

    public function getProduct ($id)
    {
        $product = array_filter($this->products['products'], function($product) use ($id) {
            return $product["id"] === (int)$id;
        });

        return response()->json($product);
    }

    public function getProducts ()
    {
        return response()->json($this->products);
    }
}
