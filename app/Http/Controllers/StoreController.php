<?php

namespace App\Http\Controllers;

use App\Enums\StoreRole;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function storesList() {
        $stores = Store::with(['products', 'owners'])
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('livewire.stores.list', compact('stores'));
    }

    public function storeProducts(Store $store) {
        return view('livewire.stores.products', compact('store'));
    }

    public function index()
    {
        $stores = Store::with(['products', 'owners'])
            ->orderByDesc('created_at')
            ->whereRelation('owners', 'user_id', '=', Auth::id())
            ->paginate(12);

        return view('livewire.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('livewire.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        // TODO: accept store image
        $store = Store::create([
            'name' => $request->name,
        ]);
        $store->users()->attach(
            auth()->user()->id,
            ['role' => StoreRole::OWNER->value],
        );

        return redirect()
            ->route('stores.index')
            ->with('success', 'Store created successfully.');
    }

    public function show(Store $store)
    {
        return view('livewire.stores.show', compact('store'));
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy(Store $store) {
        Store::destroy($store->id);

        return redirect()->route('stores.index')
            ->with('info', 'Store deleted successfully.');
    }
}
