<?php

namespace App\Utilities\MasterData\Hierarchy;

use App\Contracts\FilterContract;

class Board implements FilterContract
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
            $this->query->whereHas('parent', function ($filter) use ($value) {
                $filter->where('parent_id', $value);
            });
        }
    }
}
