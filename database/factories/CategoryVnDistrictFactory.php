<?php

namespace Database\Factories;

use App\Models\CategoryVnProvince;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryVnDistrict>
 */
class CategoryVnDistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $provinces = CategoryVnProvince::pluck('id')->toArray();
        return [
            //
            'code' => fake()->unique()->name(),
            'name' => fake()->name(),
            'category_vn_province_id' => fake()->randomElement($provinces),
        ];
    }
}
