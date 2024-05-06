<?php

namespace App\Utilities\UserManagement\Users;

use App\Contracts\FilterContract;

class Type implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value == 1) {
            $this->query->doesntHave('orders', 'and', function ($query) {
                $query->where('status', 3);
            });
        } else {
            $this->query->whereHas('orders', function ($query) {
                $query->where('status', 3);
            });
        }
    }
}
