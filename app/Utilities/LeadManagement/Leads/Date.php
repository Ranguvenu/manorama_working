<?php

namespace App\Utilities\LeadManagement\Leads;

use App\Contracts\FilterContract;

class Date implements FilterContract {

    protected $query;

    public function __construct($query) 
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value && isset($value['start']) && $value['start']) {
            $this->query->wherebetween('created_at', [$value['start'], $value['end']]);
        }
    }

}
