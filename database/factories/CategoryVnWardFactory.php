<?php

namespace Database\Factories;

use App\Models\CategoryVnDistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryVnWard>
 */
class CategoryVnWardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $districts = CategoryVnDistrict::pluck('id')->toArray();
        return [
            //
            'code' => fake()->unique()->name(),
            'name' => fake()->name(),
            'category_vn_district_id' => fake()->randomElement($districts),
        ];
    }
}
