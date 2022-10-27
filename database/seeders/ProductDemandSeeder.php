<?php

namespace Database\Seeders;

use App\Models\ProductDemand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductDemand::factory()->count(50)->create();
    }
}
