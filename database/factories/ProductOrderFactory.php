<?php

namespace Database\Factories;

use App\Models\CategoryVnDistrict;
use App\Models\CategoryVnProvince;
use App\Models\PaymentMethod;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductOrder>
 */
class ProductOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $storeAddress = fake()->randomElement(Store::all());
        $province = fake()->randomElement(CategoryVnProvince::all());
        $district = fake()->randomElement(CategoryVnDistrict::all());
        $paymentMethod = fake()->randomElement(PaymentMethod::all());
        return [
            //
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'delivery_method' => fake()->boolean(),
            'customer_address' => fake()->address(),
            'other_request' => fake()->name(),
            'is_invoice' => fake()->boolean(),
            'is_call_other' => fake()->boolean(),
            'total_price' => fake()->randomFloat(2, 0, 200000),
            'status' => fake()->numberBetween(0, 5),

            'store_province_id' => 1,
            'store_province_name' => fake()->name(),
            'store_district_id' => 1,
            'store_district_name' => fake()->name(),
            'store_address_id' => $storeAddress->id,
            'store_address_name' => $storeAddress->name,

            'customer_province_id' => $province->id,
            'customer_province_name' => $province->name,
            'customer_district_id' => $district->id,
            'customer_district_name' => $district->name,
            'payment_method_id' => $paymentMethod->id,
            'payment_method_name' => $paymentMethod->name,
        ];
    }
}
