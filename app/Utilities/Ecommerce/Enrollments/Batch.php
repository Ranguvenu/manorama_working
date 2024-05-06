<?php

namespace App\Utilities\Ecommerce\Enrollments;

use App\Contracts\FilterContract;

class Batch implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereHas('courses', function ($filter) use ($value) {
                $filter->where('batch_id', $value);
            });
        }
    }
}
