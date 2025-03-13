<?php

namespace App\Http\Controllers;

use App\Enums\TransactionAction;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['actor', 'product', 'store'])
            ->paginate(20);

        return view('livewire.transactions.index', compact('transactions'));
    }

    public function order(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
        ]);

//        dd($request->all());

        $products = Product::whereIn('id', $request->products)->get();

        $transactions = [];
        $actorId = auth()->id();
        $storeId= $request->store_id;
        $action = TransactionAction::SALE->value;
        $now = now();

        foreach ($products as $product) {
            $transactions[] = [
                'actor_id' => $actorId,
                'product_id' => $product->id,
                'store_id' => $storeId,
                'action' => $action,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Transaction::insert($transactions);

        return redirect()
            ->route('stores.list')
            ->with('success', 'Order placed successfully');
    }
}
