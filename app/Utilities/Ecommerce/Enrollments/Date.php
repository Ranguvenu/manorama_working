<?php

namespace App\Utilities\Ecommerce\Enrollments;

use App\Contracts\FilterContract;
use Carbon\Carbon;

class Date implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if (!empty($value['start']) && !empty($value['end'])) {
            $startDate = date_create_from_format('Y-m-d', $value['start']);
            $endDate = date_create_from_format('Y-m-d', $value['end']);

            if ($startDate !== false && $endDate !== false) {
                $startDate = Carbon::instance($startDate)->startOfDay();
                $endDate = Carbon::instance($endDate)->endOfDay();

                $this->query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }
    }
}
