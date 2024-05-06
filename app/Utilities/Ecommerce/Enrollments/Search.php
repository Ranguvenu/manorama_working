<?php

namespace App\Utilities\Ecommerce\Enrollments;

use App\Contracts\FilterContract;

class Search implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereHas('user', function ($filter) use ($value) {
                $filter->where('email', 'LIKE', '%'.$value.'%');
            });
        }
    }
}
