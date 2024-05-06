<?php

namespace App\Utilities\Ecommerce\Batches;

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
            // Your filtering logic goes here
            $this->query->whereHas('course', function ($filter) use ($value) {
                $filter->where('name', 'LIKE', '%'.$value.'%');
            });
        }
    }
}
