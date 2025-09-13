<?php

return [

    'required' => 'O campo :attribute é obrigatório.',
    'string' => 'O campo :attribute deve ser uma string.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'string' => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'array' => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'array' => 'O campo :attribute deve ser um array.',

    'attributes' => [
        'produtos' => 'produtos',
        'produtos.*.nome' => 'nome do produto',
        'produtos.*.valor' => 'valor do produto',
        'produtos.*.quantidade' => 'quantidade do produto',
        'metodo_pagamento' => 'método de pagamento',
        'parcelas' => 'parcelas',
    ],
];
