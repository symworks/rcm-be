<?php

namespace Database\Seeders;

use App\Models\CategoryVnDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryVnDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $district = new CategoryVnDistrict();
        $district->id = 1;
        $district->code = 'sdjvnjsdn';
        $district->name = 'asdjnfjnswda wdujfwin';
        $district->category_vn_province_id = 1;
        $district->save();

        CategoryVnDistrict::factory()->count(100)->create();
    }
}
