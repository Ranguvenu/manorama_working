<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\College;
use App\Models\Modules\Media;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\Universities>
 */
class UniversitiesFactory extends Factory
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
            "code"              =>      Str::random(100),
            "established_on"    =>      fake()->randomDigit(4),
            "address"           =>      fake()->address(),
            "pincode"           =>      fake()->randomDigit(6),
            "location"          =>      fake()->city(),
            "state"             =>      fake()->text(),
            "country"           =>      fake()->country(),
            "phone"             =>      fake()->randomDigit(10),
            "email"             =>      fake()->email(),
            "fax"               =>      fake()->randomDigit(6),
            "website"           =>      fake()->url(),
            "logo_id"           =>      Media::factory(),
            "description"       =>      Str::random(50),
            "is_published"      =>      fake()->boolean(),
        ];
    }
}
