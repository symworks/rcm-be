<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductBrand>
 */
class ProductBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productTypeIds = ProductType::pluck('id')->toArray();
        return [
            //
            'name' => fake()->name(),
            'logo' => fake()->imageUrl(100, 35),
            'product_type_id' => fake()->randomElement($productTypeIds),
        ];
    }
}
