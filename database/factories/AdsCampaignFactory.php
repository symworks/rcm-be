<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdsCampaign>
 */
class AdsCampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' => fake()->name(),
            'original' => fake()->imageUrl(800, 200),
            'thumbnail' => fake()->imageUrl(800, 500),
            'link_to_campaign' => fake()->imageUrl(),
            'is_active' => fake()->boolean(),
        ];
    }
}
