<?php

namespace App\Utilities\UserManagement\Users;

use App\Contracts\FilterContract;

class Date implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if($value){
            // Member Since -> filtering the users created after the input date.
            $this->query->whereDate('created_at', '>=', $value);
        }
    }

}
