<?php

namespace Database\Seeders;

use App\Models\CategoryRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $supperUserRole = new CategoryRole();
        $supperUserRole->id = 1;
        $supperUserRole->code = 'SupperUser';
        $supperUserRole->name = 'Supper User';
        $supperUserRole->is_system_role = true;

        $adminRole = new CategoryRole();
        $adminRole->id = 2;
        $adminRole->code = 'Admin';
        $adminRole->name = 'Admin';
        $adminRole->is_system_role = true;

        $standardRole = new CategoryRole();
        $standardRole->id = 3;
        $standardRole->code = 'Standard';
        $standardRole->name = 'Standard';
        $standardRole->is_system_role = true;

        $supperUserRole->save();
        $adminRole->save();
        $standardRole->save();

        CategoryRole::factory()->count(50)->create();
    }
}
