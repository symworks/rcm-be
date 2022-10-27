<?php

namespace Database\Factories;

use App\Models\CategoryCurrency;
use App\Models\CategoryProduct;
use App\Models\CategoryProductType;
use App\Models\Producer;
use App\Models\CategoryProductBrand;
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
        $producers = Producer::pluck('id')->toArray();
        $categoryCurrencies = CategoryCurrency::pluck('id')->toArray();
        $categoryProducts = CategoryProduct::pluck('id')->toArray();
        $categoryProductTypes = CategoryProductType::pluck('id')->toArray();

        return [
            //
            'name' => fake()->name(),
            'top_features' => fake()->name(),
            'description' => fake()->name(),
            'is_discount' => fake()->boolean(),
            'is_trending' => fake()->boolean(),
            'origin_price' => fake()->randomFloat(2, 0, 200000),
            'official_price' => fake()->randomFloat(2, 0, 200000),
            'average_evaluation' => fake()->randomFloat(2, 0, 5),
            'total_evaluation' => fake()->numberBetween(0, 1000),
            'image_1' => fake()->imageUrl(),
            'image_2' => fake()->imageUrl(),
            'image_3' => fake()->imageUrl(),
            'image_4' => fake()->imageUrl(),
            'image_5' => fake()->imageUrl(),

            'producer_id' => fake()->randomElement($producers),
            'category_currency_id' => fake()->randomElement($categoryCurrencies),
            'category_product_id' => fake()->randomElement($categoryProducts),
            'category_product_type_id' => fake()->randomElement($categoryProductTypes),
        ];
    }
}
