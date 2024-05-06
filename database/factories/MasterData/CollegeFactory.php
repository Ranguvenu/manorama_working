<?php

namespace Database\Factories\MasterData;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasterData\College;
use App\Models\MasterData\CollegeFacilities;
use App\Models\Modules\Media;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\College>
 */
class CollegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        if(College::count()){
            $CollegeFacilities = CollegeFacilities::available_facilities();
            foreach($CollegeFacilities AS $col){
                CollegeFacilities::factory(1)->create([
                    'college_id' => College::latest()->first()->id,
                    'slug' => $col['slug'],
                    'name' => $col['name']
                ]);
            }
        }


        return [
            "name"                      => fake()->name(),
            "established_year"          => fake()->year(),
            "type"                      => fake()->text(),
            "address"                   => fake()->address(),
            "country"                   => fake()->country(),
            "state"                     => fake()->text(),
            "district"                  => fake()->name(),
            "pincode"                   => fake()->postcode(),
            "contact_person"            => fake()->name(),
            "phone"                     => fake()->randomDigit(10),
            "fax"                       => fake()->randomDigit(10),
            "email"                     => fake()->email(),
            "website"                   => fake()->url(),
            "student_intake"            => fake()->randomDigit(3),
            "is_deemed"                 => fake()->boolean(),
            "name_of_principal"         => fake()->name(),
            "contact_no_of_principal"   => fake()->randomDigit(10),
            "email_of_principal"        => fake()->email(),
            "admin"                     => fake()->name(),
            "short_description"         => fake()->name(),
            "why_join"                  => fake()->name(),
            "high_light_text"           => Str::random(100),
            "similar_location"          => fake()->city(),
            "similar_college"           => Str::random(100),
            "logo_id"                   => Media::factory(),
            "brochure_id"               => Media::factory(),
            "application_form_id"       => Media::factory()
        ];
    }
}
