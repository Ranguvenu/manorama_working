<?php

namespace App\Utilities\Ecommerce\Packages;

use App\Contracts\FilterContract;

class Subject implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if ($value) {
            $this->query->whereHas('courses', function ($filter) use ($value) {
                $filter->where('course_id', $value);
            });
        }
    }

}