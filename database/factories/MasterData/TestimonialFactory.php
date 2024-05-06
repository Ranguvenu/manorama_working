<?php

namespace Database\Factories\MasterData;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "profile"           =>    fake()->name(),
            "name"              =>    fake()->name(),
            "title"             =>    fake()->name(),
            "testimonial"       =>    fake()->text(),
            "product_id"        =>    fake()->randomDigit(4), 
            "user_id"           =>    User::all()->random()->id 
        ];
    }
}
