<?php

namespace App\Utilities\Ecommerce\Enrollments;

use App\Contracts\FilterContract;

class Package implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->where('package_id',$value);
        }
    }
}
