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
        $productTypes = ProductType::pluck('id')->toArray();

        return [
            //
            'name' => fake()->name(),
            'top_features' => fake()->paragraph(5, 2),
            'description' => fake()->paragraph(50, 3),
            'product_info' => fake()->paragraph(4),
            'is_discount' => fake()->boolean(),
            'is_trending' => fake()->boolean(),
            'origin_price' => fake()->randomFloat(2, 0, 200000),
            'official_price' => fake()->randomFloat(2, 0, 200000),
            'average_evaluation' => fake()->randomFloat(2, 0, 5),
            'total_evaluation' => fake()->numberBetween(0, 1000),
            'image_1' => fake()->imageUrl(400, 400),
            'image_2' => fake()->imageUrl(400, 400),
            'image_3' => fake()->imageUrl(400, 400),
            'image_4' => fake()->imageUrl(400, 400),
            'image_5' => fake()->imageUrl(400, 400),
            'product_type_id' => fake()->randomElement($productTypes),
        ];
    }
}
