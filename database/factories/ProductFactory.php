<?php

namespace Database\Factories;

use App\Models\CategoryCurrency;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productType = fake()->randomElement(ProductType::all());

        return [
            //
            'name' => fake()->name(),
            'top_features' => fake()->paragraph(5, 2),
            'description' => fake()->paragraph(50, 3),
            'product_info' => fake()->paragraph(4),
            'average_evaluation' => fake()->randomFloat(2, 0, 5),
            'total_evaluation' => fake()->numberBetween(0, 1000),
            'product_type_id' => $productType->id,
            'product_type_name' => $productType->name,
        ];
    }
}
