<?php

namespace App\Utilities\Notifications\Templates\Email;

use App\Contracts\FilterContract;

class Status implements FilterContract {

    protected $query;

    public function __construct($query) 
    {
        $this->query = $query;
    }

    public function handle($value): void 
    {
        if($value > -1){
            $this->query->where('status', $value);
        }
    }

}
