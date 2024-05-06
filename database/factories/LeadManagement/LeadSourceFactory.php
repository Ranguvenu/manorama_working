<?php

namespace Database\Factories\LeadManagement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeadManagement\LeadSource;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadManagement\LeadSource>
 */
class LeadSourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "name" => fake()->name(),
            "code" => fake()->text()
        ];
    }
}
