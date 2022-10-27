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
        $storeAddressIds = Store::where('province_address_id', 1)->where('district_address_id', 1)->pluck('id')->toArray();
        $provinceIds = CategoryVnProvince::pluck('id')->toArray();
        $districtIds = CategoryVnDistrict::pluck('id')->toArray();
        $paymentMethodIds = PaymentMethod::pluck('id')->toArray();
        return [
            //
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'delivery_method' => fake()->boolean(),
            'customer_address' => fake()->address(),
            'other_request' => fake()->paragraph(),
            'is_invoice' => fake()->boolean(),
            'is_call_other' => fake()->boolean(),
            'total_price' => fake()->randomFloat(2, 0, 200000),
            'status' => fake()->numberBetween(0, 5),

            'store_province_id' => 1,
            'store_province_name' => fake()->name(),
            'store_district_id' => 1,
            'store_district_name' => fake()->name(),
            'store_address_id' => fake()->randomElement($storeAddressIds),

            'customer_province_id' => fake()->randomElement($provinceIds),
            'customer_province_name' => fake()->name(),
            'customer_district_id' => fake()->randomElement($districtIds),
            'customer_district_name' => fake()->name(),
            'payment_method_id' => fake()->randomElement($paymentMethodIds),
        ];
    }
}
