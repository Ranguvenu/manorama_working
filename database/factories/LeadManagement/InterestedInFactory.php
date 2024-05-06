<?php

namespace Database\Factories\LeadManagement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeadManagement\InterestedIn;
use App\Models\LeadManagement\Lead;
use App\Models\LeadManagement\LeadSource;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadManagement\InterestedIn>
 */
class InterestedInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "lead_id"              => Lead::factory(),
            "product_id"           => fake()->randomDigit(4),
            "received_from"        => Str::random(50),
            "source_id"            => Lead::factory(),
            "status"               => fake()->randomDigit(4)
        ];
    }
}
