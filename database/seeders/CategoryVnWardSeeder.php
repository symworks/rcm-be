<?php

namespace Database\Seeders;

use App\Models\CategoryVnWard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryVnWardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoryVnWard::factory()->count(500)->create();
    }
}
