<?php

namespace Database\Seeders;

use App\Models\CategoryProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoryProductType::factory()->count(50)->create();
    }
}
