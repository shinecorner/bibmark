<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function random()
    {
        $result = new ProductResource(Product::inRandomOrder()->first());

        return response()->json($result, 200);
    }
}
