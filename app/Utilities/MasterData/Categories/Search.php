<?php

namespace App\Utilities\MasterData\Categories;

use App\Contracts\FilterContract;

class Search implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if($value){
            $this->query->where('name', 'LIKE',  '%'.$value.'%');
        }
    }

}