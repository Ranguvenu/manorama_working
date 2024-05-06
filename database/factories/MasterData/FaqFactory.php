<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\Faq;
use App\Models\MasterData\Taxonomy;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $taxonomy = Taxonomy::findOrFail('faq');
        return [
            "category_id"              =>      $taxonomy->categories()->first()->id,
            "title"                    =>      fake()->text(100),
            "description"              =>      fake()->text(100),
            "status"                   =>      fake()->boolean(),
            "created_by"               =>      User::all()->random()->id,
            "updated_by"               =>      User::all()->random()->id
        ];
    }
}
