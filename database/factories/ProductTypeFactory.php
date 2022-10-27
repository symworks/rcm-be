<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductType>
 */
class ProductTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ui_icons = ['icon-screen-tablet', 'icon-earphones', 'icon-star', 'icon-trash', 'icon-plus'];
        return [
            //
            'name' => fake()->unique()->name(),
            'is_active' => fake()->boolean(),
            'ui_icon' => fake()->randomElement($ui_icons),
        ];
    }
}
