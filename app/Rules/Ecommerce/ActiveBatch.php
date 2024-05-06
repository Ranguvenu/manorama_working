<?php

namespace App\Rules\Ecommerce;

use App\Models\Ecommerce\Packages;
use Illuminate\Contracts\Validation\Rule;

class ActiveBatch implements Rule
{
    protected $package;

    protected $subject;

    public function __construct(Packages $package, $subject)
    {
        $this->package = $package;
        $this->subject = $subject;
    }

    public function passes($attribute, $value)
    {
        if ($this->package->courses()->count() > 1) {
            if ($value) {
                $hasactivebatches = $this->package->batches()->active()->where('hierarchy_id', $this->subject)->count();

                return $hasactivebatches ? false : true;
            }
        }

        return true;
    }

    public function message()
    {
        return 'An active batch already exists for this course, You cannot have more than one active batch if you have more than one course in your package';
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
