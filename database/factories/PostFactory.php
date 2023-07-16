<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake() -> email,
            'address' => fake() -> address(),
            'tel' => fake() -> phonenumber(),
            'site_name' => fake() -> realText($maxNbChars = 10),
            'site_url' => fake() -> url,
            'user_id' => fake() -> numberBetween($max=1, $min=1)
            
                ];
    }
}
