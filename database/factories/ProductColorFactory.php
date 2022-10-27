<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColor>
 */
class ProductColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        return [
            //
            'name' => fake()->name(),
            'rgb_value' => fake()->rgbColor(),
            'is_default' => fake()->boolean(),
            'product_id' => fake()->randomElement($productIds),
        ];
    }
}
