<?php

namespace Database\Factories;

use App\Models\ProductColor;
use App\Models\ProductVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColorQty>
 */
class ProductColorQtyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productVersionIds = ProductVersion::where('product_id', 1)->pluck('id')->toArray();
        $productColorIds = ProductColor::where('product_id', 1)->pluck('id')->toArray();
        return [
            //
            'instock_qty' => fake()->numberBetween(0, 500),
            'sold_qty' => fake()->numberBetween(0, 500),
            'busy_qty' => fake()->numberBetween(0, 500),
            'product_version_id' => fake()->randomElement($productVersionIds),
            'product_color_id' => fake()->randomElement($productColorIds),
        ];
    }
}
