<?php

namespace App\Utilities\Modules\Media;

use App\Contracts\FilterContract;

class Accepts implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $extensions = explode(',', $value);
            if ($extensions && sizeof($extensions)) {
                $this->query->whereIn('extension', $extensions);
            }
        }
    }
}
