<?php

namespace App\Utilities\Content\StudyMaterials;

use App\Contracts\FilterContract;

class Subject implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void {
        if ($value) {
            $this->query->where('subject_id', $value);
        }
    }

}