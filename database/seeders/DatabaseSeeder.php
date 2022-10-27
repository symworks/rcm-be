<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CategoryNationSeeder::class);
        $this->call(CategoryCurrencySeeder::class);
        $this->call(CategoryRoleSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductDemandSeeder::class);
        $this->call(ProductBrandSeeder::class);
        $this->call(PriceRangeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdsCampaignSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(ProductVersionSeeder::class);
        $this->call(ProductColorQtySeeder::class);
        $this->call(ProductEvaluateSeeder::class);
        $this->call(CategoryVnProvinceSeeder::class);
        $this->call(CategoryVnDistrictSeeder::class);
        $this->call(CategoryVnWardSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ProductOrderSeeder::class);
        $this->call(ProductOrderDetailSeeder::class);
    }
}
