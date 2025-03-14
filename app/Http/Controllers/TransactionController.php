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
        ], [
            'products.required' => 'Please select at least one product.',
        ]);

        $products = Product::whereIn('id', $request->products)->get();

        $transactions = [];
        $actorId = auth()->id();
        $storeId= $request->store_id;
        $action = TransactionAction::SALE->value;
        $quantity = 1;
        $now = now();

        // Subtract 1 from the quantity of each product in the store
        $products->each(function ($product) use ($storeId, $quantity) {
            $qty = $product->stores()->first()->pivot->quantity;

            // check still has enough quantity in store
            if ($qty <= 0) {
                $msg = 'Product '. $product->name . ' does not has enough stock in store';
                return redirect()->route('stores.list')->with('error', $msg);
            }

            $product->stores()->updateExistingPivot($storeId, [
                'quantity' => $qty - $quantity,
            ]);
        });

        foreach ($products as $product) {
            $transactions[] = [
                'actor_id' => $actorId,
                'product_id' => $product->id,
                'store_id' => $storeId,
                'action' => $action,
                'quantity' => $quantity,
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
