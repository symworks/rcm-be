<?php

namespace Database\Seeders;

use App\Models\CategoryProductBrand;
use Illuminate\Database\Seeder;

class CategoryProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //       
        CategoryProductBrand::factory()->count(50)->create();
    }
}
