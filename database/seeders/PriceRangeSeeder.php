<?php

namespace Database\Seeders;

use App\Models\PriceRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PriceRange::factory()->count(50)->create();
    }
}
