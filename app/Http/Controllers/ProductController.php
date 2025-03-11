<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderByDesc('updated_at')
            ->paginate(8);

        return view('livewire.products.index', compact('products'));
    }

    public function show(Product $product) {
        return view('livewire.products.show', compact('product'));
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

    public function edit(Product $product) {
        return view('livewire.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'code' => [
                'required', 'alpha_num',
                Rule::unique('products')->ignore($product->id)
            ],
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect()
            ->route('products.index')
            ->with('info', 'Product updated successfully');
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect()->route('products.index');
    }
}
