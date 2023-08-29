<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => fake() -> realText($maxNbChars = 10),
            'site_url' => fake() -> url,
            'post_id' => fake() -> numberBetween($max=1, $min=1)
            
                ];
    }
}
