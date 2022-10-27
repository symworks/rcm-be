<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceRange>
 */
class PriceRangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = [1, 2, 3, 4, 5];
        return [
            //
            'min_price' => fake()->randomFloat(2, 0, 200000),
            'max_price' => fake()->randomFloat(2, 0, 200000),
            'product_id' => fake()->randomElement($products),
        ];
    }
}
