<?php

namespace App\Utilities\LeadManagement\Leads;

use App\Contracts\FilterContract;

class Agent implements FilterContract {

    protected $query;

    public function __construct($query) 
    {
        $this->query = $query;
    }

    public function handle($value): void 
    {
        if ($value) {
            $this->query->whereHas('assignment', function ($filter) use ($value) {
                $filter->where([
                    [function ($query) use ($value) {
                        $query->orWhere('assigned_to_id', '=',  $value);
                    }],
                ]);
            });
        }
    }

}