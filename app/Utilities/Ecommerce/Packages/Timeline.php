<?php

namespace App\Utilities\Ecommerce\Packages;

use App\Contracts\FilterContract;

class Timeline implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {       
            $now = now();
            if ($value == 'future') {               
                $this->query->where('enrollment_end_date', '>=', $now->startOfDay());
            } else if ($value == 'past') {
                $this->query->where('enrollment_end_date', '<', $now->startOfDay());
            }
        }
    }
    
}
