<?php

namespace App\Utilities\MasterData\Hierarchy;

use App\Contracts\FilterContract;

class Code implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value && is_array($value)) {
            // Your filtering logic goes here
            $this->query->whereIn('code', $value);
        } else {
            $this->query->where('code', $value);
        }
    }
}
