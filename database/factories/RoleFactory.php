<?php

namespace Database\Factories;

use App\Models\CategoryRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $categoryRole = fake()->randomElement(CategoryRole::all());
        return [
            //
            'user_id' => fake()->randomElement($users),
            'category_role_id' => $categoryRole->id,
            'category_role_name' => $categoryRole->name,
        ];
    }
}
