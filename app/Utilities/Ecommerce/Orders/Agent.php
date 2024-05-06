<?php

namespace App\Utilities\Ecommerce\Orders;

use App\Contracts\FilterContract;

class Agent implements FilterContract {

    protected $query;

    public function __construct($query) 
    {
        $this->query = $query;
    }

    public function handle($value): void 
    {
        if($value){
            $this->query->where('agent_id', '=',  $value);        
        }
    }

}