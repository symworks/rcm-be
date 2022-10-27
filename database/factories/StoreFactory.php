<?php

namespace Database\Factories;

use App\Models\CategoryVnDistrict;
use App\Models\CategoryVnProvince;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => fake()->name(),
            'address_detail' => fake()->address(),
            'province_address_id' => 1,
            'district_address_id' => 1,
            'ward_address_id' => 1, 
        ];
    }
}
