<?php

namespace App\Utilities\Website\Pages;

use App\Contracts\FilterContract;

class Status implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {        
            // Your filtering logic goes here
       $this->query->where('status',$value);
    }
    
}
