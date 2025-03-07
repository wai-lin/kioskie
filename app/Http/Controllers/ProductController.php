<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(8);
        return view('livewire.products.index', compact('products'));
    }

    public function show(Product $product) {
        return view('livewire.products.index', compact('product'));
    }
}
