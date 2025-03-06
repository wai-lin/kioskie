<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Auth::user()->stores;
        $stores = $stores->load(['products', 'owners']);

        return view('livewire.stores.index', compact('stores'));
    }

    public function create() {
        return view('livewire.stores.create');
    }

    public function store(Request $request) {}

    public function show(Store $store) {
        return view('livewire.stores.show', compact('store'));
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
