<?php

namespace App\Utilities\MasterData\Hierarchy;

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
            $this->query->whereHas('parent', function ($filter) use ($value) {
                $filter->whereHas('parent', function ($filter) use ($value) {
                    $filter->where('parent_id', $value);
                });
            });
        }
    }
}
