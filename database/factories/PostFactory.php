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
            'user_id' => fake() -> numberBetween($max=3, $min=1)
            
                ];
    }
}
