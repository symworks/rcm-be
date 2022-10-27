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
        $productId = fake()->randomElement(Product::pluck('id')->toArray());
        return [
            //
            'name' => fake()->unique()->name(),
            'origin_price' => fake()->randomFloat(2, 0, 200000),
            'official_price' => fake()->randomFloat(2, 0, 200000),

            'instock_qty' => fake()->numberBetween(0, 500),
            'sold_qty' => fake()->numberBetween(0, 500),
            'busy_qty' => fake()->numberBetween(0, 500),

            'product_id' => $productId,
            'product_image_id' => fake()->randomElement(ProductImage::where('product_id', $productId)->pluck('id')->toArray()),
        ];
    }
}
