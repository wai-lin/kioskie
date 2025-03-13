<?php

namespace App\Http\Controllers;

use App\Enums\StoreRole;
use App\Enums\TransactionAction;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['products', 'owners'])
            ->orderByDesc('updated_at')
            ->whereRelation('owners', 'user_id', '=', Auth::id())
            ->paginate(12);

        return view('livewire.stores.index', compact('stores'));
    }

    public function show(Store $store)
    {
        $store->load(['products', 'owners']);

        $isOwner = $store->owners()->where('user_id', Auth::id())->exists();

        return view('livewire.stores.show', compact('store', 'isOwner'));
    }

    public function create()
    {
        return view('livewire.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3|max:255',
        ]);

        $store = Store::create([
            'name' => $request->name,
        ]);
        $store->users()->attach(
            auth()->user()->id,
            ['role' => StoreRole::OWNER->value],
        );

        if ($request->hasFile('logo')) {
            $store->addMediafromRequest('logo')
                ->toMediaLibrary('stores');
        }

        return redirect()
            ->route('stores.index')
            ->with('success', 'Store created successfully.');
    }

    public function edit(Store $store)
    {
        return view('livewire.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3|max:255',
        ]);

        $store->update([
            'name' => $request->name
        ]);
        if ($request->hasFile('logo')) {
            $store->media()->each(fn ($m) => $m->delete());
            $store->addMediafromRequest('logo')
                ->toMediaLibrary('stores');
        }

        return redirect()
            ->route('stores.index')
            ->with('info', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        Store::destroy($store->id);

        return redirect()->route('stores.index')
            ->with('info', 'Store deleted successfully.');
    }

    public function showStoresList()
    {
        $stores = Store::with(['products', 'owners'])
            ->orderByDesc('updated_at')
            ->paginate(12);

        return view('livewire.stores.list', compact('stores'));
    }

    public function showStoreProducts(Store $store)
    {
        return view('livewire.stores.products', compact('store'));
    }

    public function linkProductsForm(Store $store)
    {
        $products = Product::whereDoesntHave('stores', function ($query) use ($store) {
            $query->where('store_id', $store->id);
        })->get();

        return view('livewire.stores.link_products', compact('store', 'products'));
    }

    public function linkProducts(Request $request, Store $store)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        foreach ($request->products as $product) {
            $store->products()->attach($product, ['quantity' => 0]);
        }

        return redirect()
            ->route('stores.show', $store)
            ->with('success', 'Products linked successfully.');
    }

    public function editProductStockForm(Store $store, Product $product)
    {
        return view('livewire.stores.edit_stock', compact('store', 'product'));
    }

    public function editProductStock(Request $request, Store $store, Product $product)
    {
        $addStock = TransactionAction::ADD_STOCK->value;
        $removeStock = TransactionAction::REMOVE_STOCK->value;
        $request->validate([
            'action' => ['required', Rule::in($addStock, $removeStock)],
            'amount' => 'required|integer|min:1',
        ]);

        $productQty = $store->products()->where('product_id', $product->id)->first()->pivot->quantity ?? 0;
        $newQty = match ($request->action) {
            $addStock => $productQty + $request->amount,
            $removeStock => $productQty - $request->amount,
        };

        $store->products()->updateExistingPivot($product->id, [
            'quantity' => $newQty,
        ]);

        Transaction::create([
            'store_id' => $store->id,
            'actor_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->amount,
            'action' => $request->action,
            'price' => $product->price,
        ]);

        return redirect()
            ->route('stores.show', compact('store'))
            ->with('success', 'Product stock updated successfully.');
    }
}
