<?php

namespace App\Utilities\Ecommerce\Packages;

use App\Contracts\FilterContract;

class Published implements FilterContract
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
            $this->query->where('is_published', $value);
        }
    }
}
