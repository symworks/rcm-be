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
        $productVersion = fake()->randomElement(ProductVersion::all());
        return [
            //
            'name' => fake()->name(),
            'instock_qty' => fake()->numberBetween(0, 500),
            'sold_qty' => fake()->numberBetween(0, 500),
            'busy_qty' => fake()->numberBetween(0, 500),
            'product_version_id' => $productVersion->id,
            'product_version_name' => $productVersion->name,
        ];
    }
}
