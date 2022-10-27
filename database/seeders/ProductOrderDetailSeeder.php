<?php

namespace Database\Seeders;

use App\Models\ProductOrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductOrderDetail::factory()->count(1000)->create();
    }
}
