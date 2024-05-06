<?php

namespace Database\Factories\MasterData;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\Taxonomy;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\Taxonomy>
 */
class TaxonomyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Taxonomy::class;

    public function definition(): array
    {
        return [
            "name"           =>    fake()->name(),
            "singular"       =>    fake()->name(),
            "plural"         =>    fake()->name(),
            "slug"           =>    fake()->name(),
        ];
    }
}
