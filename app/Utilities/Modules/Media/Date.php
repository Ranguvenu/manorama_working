<?php

namespace App\Utilities\Modules\Media;

use App\Contracts\FilterContract;

class Date implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value != -1) {
            $date = \Carbon\Carbon::parse($value);
            if ($date && $date->year) {
                // Your filtering logic goes here
                $this->query->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month);
            }
        }
    }
}
