<?php

namespace App\Utilities\Ecommerce\Packages;

use App\Contracts\FilterContract;

class Goalcode implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereHas('goal', function ($filter) use ($value) {
                $filter->where('code', $value);
            });
        }
    }
}
