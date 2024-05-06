<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\Agent;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"              => fake()->name(),
            "code"              => Str::random(8),
            "location"          => fake()->address(),
            "locality"          => fake()->address(),
            "created_by"        => User::all()->random()->id,
            "updated_by"        => User::all()->random()->id
        ];
    }
}
