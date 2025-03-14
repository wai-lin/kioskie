<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('updated_at')
            ->paginate(12);

        return view('livewire.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('stores');
        // return view('livewire.products.show', compact('product'));
        return redirect()->route('products.edit', compact('product'));
    }

    public function create()
    {
        return view('livewire.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'code' => 'required|alpha_num|unique:products,code',
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')
                ->toMediaLibrary('products.'.$product->id);
        }

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('livewire.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'code' => [
                'required', 'alpha_num',
                Rule::unique('products')->ignore($product->id),
            ],
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'code' => $request->code,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('products.'.$product->id);
            $product->addMediaFromRequest('image')
                ->toMediaLibrary('products.'.$product->id);
        }

        return redirect()
            ->route('products.index')
            ->with('info', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->media()->delete();
        $product->delete();

        return redirect()->route('products.index');
    }
}
