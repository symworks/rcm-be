<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $supperUser = new User();
        $supperUser->id = 1;
        $supperUser->name = 'Balebom';
        $supperUser->email = 'balebom@gmail.com';
        $supperUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $supperUser->avatar = 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200';
        $supperUser->anonymous_user = false;
        $supperUser->save();

        User::factory()->count(50)->create();
    }
}
