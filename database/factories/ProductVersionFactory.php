<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVersion>
 */
class ProductVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = Product::pluck('id')->toArray();
        return [
            //
            'name' => fake()->unique()->name(),
            'origin_price' => fake()->randomFloat(2, 0, 200000),
            'official_price' => fake()->randomFloat(2, 0, 200000),
            'is_default' => fake()->boolean(),
            'instock_qty' => fake()->numberBetween(0, 500),
            'sold_qty' => fake()->numberBetween(0, 500),
            'busy_qty' => fake()->numberBetween(0, 500),
            'product_id' => fake()->randomElement($products),
        ];
    }
}
