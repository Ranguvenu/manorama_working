<?php

namespace App\Utilities\Careers\JobPosting;

use App\Contracts\FilterContract;

class Category implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->where('category_id', $value);
        }
    }
}
