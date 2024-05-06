<?php

namespace App\Utilities\Blog\Article;

use App\Contracts\FilterContract;

class Category implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->whereRaw("find_in_set('".$value."',category)");
        }
    }
}
