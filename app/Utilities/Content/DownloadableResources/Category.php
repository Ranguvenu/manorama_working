<?php

namespace App\Utilities\Content\DownloadableResources;

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
            // Your filtering logic goes here
            $this->query->where('resource_type_id', $value);
        }
    }
}
