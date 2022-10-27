<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $recevied = new PaymentMethod();
        $recevied->id = 1;
        $recevied->name = 'Thanh toán trực tiếp';
        $recevied->logo = fake()->imageUrl(200, 100);
        $recevied->description = fake()->name();
        $recevied->save();
        PaymentMethod::factory()->count(5)->create();
    }
}
