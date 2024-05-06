<?php

namespace App\Utilities\Ecommerce\SapController;

use App\Contracts\FilterContract;

class Search implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if($value){
            $this->query->where('order_id', 'LIKE',  '%'.$value.'%');
        }
    }

}