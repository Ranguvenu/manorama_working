<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\School;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\School>
 */
class SchoolFactory extends Factory
{
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    // protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"              => fake()->name(),
            "code"              => Str::random(4),
            "location"          => fake()->city(),
            "district"          => fake()->city(),
            "state"             => fake()->state(),
            "country"           => fake()->country(),
            "address"           => fake()->address(),
            "contact_details"   => fake()->unique()->safeEmail(),
            "is_published"      => fake()->boolean(),
            "created_by"        => User::all()->random()->id,
            "updated_by"        => User::all()->random()->id
        ];
    }
}
