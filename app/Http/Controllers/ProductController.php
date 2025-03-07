<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderByDesc('created_at')->paginate(8);
        return view('livewire.products.index', compact('products'));
    }

    public function show(Product $product) {
        return view('livewire.products.index', compact('product'));
    }

    public function create() {
        return view('livewire.products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|alpha_num|unique:products,code',
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // TODO: accept product image
        Product::create($request->all());

        return redirect()->route('products.index');
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
