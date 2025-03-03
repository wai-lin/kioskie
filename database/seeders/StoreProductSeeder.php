<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreProductSeeder extends Seeder
{
    public function run(): void
    {
        $store1 = Store::find(1);
        $store2 = Store::find(2);

        $products = [
            ['name' => 'Coca Cola'],
            ['name' => 'Pringles'],
            ['name' => 'Lays'],
            ['name' => 'Pepsi'],
            ['name' => 'Fanta'],
            ['name' => 'Sprite'],
            ['name' => '7up'],
            ['name' => 'Mountain Dew'],
            ['name' => 'Mirinda'],
            ['name' => 'Doritos'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        Product::all()->each(function ($product) use ($store1, $store2) {
            $store1->products()->attach($product, ['quantity' => rand(0, 500)]);
            $store2->products()->attach($product, ['quantity' => rand(0, 500)]);
        });
    }
}
