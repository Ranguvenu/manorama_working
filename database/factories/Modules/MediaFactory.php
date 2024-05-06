<?php

namespace Database\Factories\Modules;
use App\Models\Modules\Media;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modules\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            "url"               =>    fake()->imageUrl(),
            "name"              =>    fake()->name(),
            "size"              =>    fake()->randomDigit(10),
            "component"         =>    'factories',
            "uploaded_to"       =>    fake()->randomDigit(4),
            "type"              =>    'image/png', 
            "extension"         =>    'png', 
            "title"             =>    fake()->name(), 
            "alttext"           =>    fake()->text(), 
            "description"       =>    fake()->text(), 
            "created_by"        =>    User::all()->random()->id, 
            "updated_by"        =>    User::all()->random()->id

        ];
    }
}
