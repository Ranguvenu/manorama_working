<?php

namespace App\Utilities\Ecommerce\Packages;

use App\Contracts\FilterContract;

class Payment implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if($value > -1){
            $this->query->where('is_paid', $value);
        }
    }

}