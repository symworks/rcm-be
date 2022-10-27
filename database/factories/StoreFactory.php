<?php

namespace Database\Factories;

use App\Models\CategoryVnDistrict;
use App\Models\CategoryVnProvince;
use App\Models\CategoryVnWard;
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
        $province = null;
        $district = null;
        $ward = null;

        do {
            $province = null;
            $district = null;
            $ward = null;

            $province = fake()->randomElement(CategoryVnProvince::all());
            $attempt = 15;
            do {
                $attempt = $attempt - 1;
                $district = fake()->randomElement(CategoryVnDistrict::where('category_vn_province_id', $province->id)->get());
            }
            while(!($district || $attempt == 0));
    
            if (!$district) continue;

            $attempt = 15;
            do {
                $attempt = $attempt - 1;
                $ward = fake()->randomElement(CategoryVnWard::where('category_vn_district_id', $district->id)->get());
            } while(!($ward || $attempt == 0));
        } while (!($province && $district && $ward));


        return [
            //
            'name' => fake()->name(),
            'address_detail' => fake()->address(),
            'province_address_id' => $province->id,
            'province_address_name' => $province->name,
            'district_address_id' => $district->id,
            'district_address_name' => $district->name,
            'ward_address_id' => $ward->id,
            'ward_address_name' => $ward->name,
        ];
    }
}
