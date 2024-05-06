<?php

namespace App\Utilities\Notifications\Templates\Email;

use App\Contracts\FilterContract;

class Type implements FilterContract {

    protected $query;

    public function __construct($query) 
    {
        $this->query = $query;
    }

    public function handle($value): void 
    {
        if($value){
            $this->query->where('notification_type_id', $value);
        }
    }

}
