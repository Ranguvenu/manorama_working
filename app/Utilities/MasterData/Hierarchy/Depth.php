<?php

namespace App\Utilities\MasterData\Hierarchy;

use App\Contracts\FilterContract;

class Depth implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value > -1) {
            // Your filtering logic goes here
            $this->query->where('depth', $value);
        }
    }
}
