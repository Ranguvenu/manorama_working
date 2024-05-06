<?php

namespace App\Utilities\LeadManagement\Leads;

use App\Contracts\FilterContract;

class Status implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        $this->query->where('status', '=',  $value);
        }
    }


