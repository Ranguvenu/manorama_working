<?php

namespace App\Utilities\LeadManagement\Leads;

use App\Contracts\FilterContract;

class Search implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereHas('leads', function ($filter) use ($value) {
                $filter->where([
                    [function ($query) use ($value) {
                        $query->orWhere('name', 'LIKE', '%'.$value.'%')
                        ->orWhere('phone_number', 'LIKE', '%'.$value.'%')
                        ->orWhere('email', 'LIKE', '%'.$value.'%');
                    }],
                ]);
            });
        }
    }
}
