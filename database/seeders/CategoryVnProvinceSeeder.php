<?php

namespace Database\Seeders;

use App\Models\CategoryVnProvince;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryVnProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoryVnProvince::factory()->count(50)->create();
    }
}
