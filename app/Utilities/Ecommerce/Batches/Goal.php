<?php

namespace App\Utilities\Ecommerce\Batches;

use App\Contracts\FilterContract;

class Goal implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereHas('package', function ($filter) use ($value) {
                $filter->whereHas('goal', function ($filter) use ($value) {
                    $filter->where('id', $value);
                });
            });
        }
    }
}
