<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDemand>
 */
class ProductDemandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_ids = [1, 2, 3, 4, 5, 6, 7];
        return [
            //
            'name' => fake()->name(),
            'product_id' => fake()->randomElement($product_ids),
        ];
    }
}
