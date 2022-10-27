<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductEvaluate>
 */
class ProductEvaluateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = Product::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        return [
            //
            'num_star' => fake()->numberBetween(0, 5),
            'content' => fake()->paragraph(2),
            'product_id' => fake()->randomElement($products),
            'created_by_id' => fake()->randomElement($users),
        ];
    }
}
