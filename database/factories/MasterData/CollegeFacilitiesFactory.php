<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\CollegeFacilities;
use App\Models\MasterData\College;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\CollegeFacilities>
 */
class CollegeFacilitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "college_id"              =>      College::factory(),
            "slug"                    =>      Str::random(15),
            "name"                    =>      fake()->name(),
            "is_available"            =>      fake()->boolean(),
            "description"             =>      Str::random(100),
        ];
    }
}
