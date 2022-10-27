<?php

namespace Database\Seeders;

use App\Models\ProductEvaluate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductEvaluateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductEvaluate::factory()->count(2000)->create();
    }
}
