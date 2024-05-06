<?php

namespace App\Utilities\Website\Pages;

use App\Contracts\FilterContract;

class Author implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if ($value) {
             $this->query->where('created_by', $value);    
        }
    }   
}

