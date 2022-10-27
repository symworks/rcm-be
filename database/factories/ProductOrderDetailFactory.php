<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductOrderDetail>
 */
class ProductOrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productOrderIds = ProductOrder::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
        return [
            //
            'order_qty' => fake()->numberBetween(0, 500),
            'product_order_id' => fake()->randomElement($productOrderIds),
            'product_id' => fake()->randomElement($productIds),
        ];
    }
}
