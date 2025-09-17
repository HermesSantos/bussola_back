<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $products;

    function __construct () {
        $this->products = config('mock');
    }

    public function getProduct ($id)
    {
        $product = collect($this->products['products'])
            ->where('id', $id)
            ->first();

        return response()->json($product);
    }

    public function getProducts ()
    {
        return response()->json($this->products);
    }
}
