<?php

namespace Database\Factories\LeadManagement;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeadManagement\LeadAssignment;
use App\Models\LeadManagement\InterestedIn;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadManagement\LeadAssignment>
 */
class LeadAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "interested_in_id"              =>      InterestedIn::factory(),
            "user_id"                       =>      User::factory(),
            "assigned_by"                   =>      User::factory()
        ];
    }
}
