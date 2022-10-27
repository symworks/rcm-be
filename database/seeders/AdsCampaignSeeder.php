<?php

namespace Database\Seeders;

use App\Models\AdsCampaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AdsCampaign::factory()->count(50)->create();
    }
}
