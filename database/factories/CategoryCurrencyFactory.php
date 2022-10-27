<?php

namespace Database\Factories;

use App\Models\CategoryNation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryCurrency>
 */
class CategoryCurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categoryNations = CategoryNation::pluck('id')->toArray();
        return [
            //
            'code' => fake()->unique()->currencyCode(),
            'name' => fake()->name(),

            'category_nation_id' => fake()->randomElement($categoryNations),
        ];
    }
}
