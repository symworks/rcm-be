<?php

namespace Database\Seeders;

use App\Models\ProductColorQty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductColorQtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductColorQty::factory()->count(5)->create();
    }
}
