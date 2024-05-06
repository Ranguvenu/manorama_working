<?php

namespace App\Rules\Ecommerce;

use App\Models\Ecommerce\Packages;
use Illuminate\Contracts\Validation\Rule;

class PackagePricingCombination implements Rule
{
    protected $package;

    protected $subjects;

    public function __construct(Packages $package, $subjects)
    {
        $this->package = $package;
        $this->subjects = $subjects;
    }

    public function passes($attribute, $value)
    {
        $exists = $this->package->pricing()->whereHas('courses', function ($query) {
            $query->whereIn('course_id', $this->subjects);
        }, '>=', count($this->subjects))->whereDoesntHave('courses', function ($query) {
            $query->whereNotIn('course_id', $this->subjects);
        })->exists();

        return !$exists;
    }

    public function message()
    {
        return 'A pricing already exists for this combination of courses.';
    }

    // /**
    //  * Run the validation rule.
    //  *
    //  * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
    //  */
    public function validate($attribute, $value, $parameters, $validator): void
    {
        if (!$this->passes($attribute, $value)) {
            $validator->errors()->add($attribute, $this->message());
        }
    }
}
