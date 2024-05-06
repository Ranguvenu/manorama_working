<?php

namespace Database\Factories\LeadManagement;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeadManagement\Lead;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadManagement\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"              =>      fake()->name(),
            "country_code"      =>      fake()->text(),
            "phone_number"      =>      fake()->randomDigit(10),
            "email"             =>      fake()->email(),
            "tags"              =>      Str::random(50),
            "created_by"        =>      User::factory(),
            "updated_by"        =>      User::factory()
        ];
    }
}
