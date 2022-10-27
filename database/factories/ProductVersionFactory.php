<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
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
        $product = fake()->randomElement(Product::all());
        return [
            //
            'name' => fake()->unique()->name(),
            'origin_price' => fake()->randomFloat(2, 0, 200000),
            'official_price' => fake()->randomFloat(2, 0, 200000),
            'default_image' => fake()->imageUrl(400, 400),

            'instock_qty' => fake()->numberBetween(0, 500),
            'sold_qty' => fake()->numberBetween(0, 500),
            'busy_qty' => fake()->numberBetween(0, 500),

            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_type_id' => $product->product_type_id,
            'product_type_name' => $product->product_type_name,
        ];
    }
}
