<?php

namespace App\Utilities\MasterData\Testimonials;

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
            // Your filtering logic goes here
            $this->query->where('product_id', $value);
        }
    }
}
