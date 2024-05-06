<?php

namespace Database\Factories\LeadManagement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeadManagement\LeadRegistration;
use App\Models\User;
use App\Models\LeadManagement\Lead;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadManagement\LeadRegistration>
 */
class LeadRegistrationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            "lead_id"               =>      Lead::factory(),
            "user_id"               =>      User::factory(),
            "registered_by"         =>      User::factory()
        ];

    }
}
