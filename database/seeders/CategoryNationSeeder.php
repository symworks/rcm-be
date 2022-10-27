<?php

namespace Database\Seeders;

use App\Models\CategoryNation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryNationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoryNation::factory()->count(50)->create();
    }
}
