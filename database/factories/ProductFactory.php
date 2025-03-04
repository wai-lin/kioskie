<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->randomNumber(5),
            'name' => fake()->name,
            'price' => fake()->randomFloat(2, 1, 1000),
        ];
    }
}
