<?php

namespace App\Utilities\Ecommerce\Packages;

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
        if ($value && isset($value['start']) && $value['start']) {
            $this->query->wherebetween('valid_from', [$value['start'], $value['end']]);
        }
    }
}
