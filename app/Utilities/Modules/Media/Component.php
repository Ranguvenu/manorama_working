<?php

namespace App\Utilities\Modules\Media;

use App\Contracts\FilterContract;

class Component implements FilterContract
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
            $this->query->where('component', $value);
        }
    }
}
