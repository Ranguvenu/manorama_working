<?php

namespace App\Utilities\Notifications\EmailNotifications;

use App\Contracts\FilterContract;

class Search implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value) {
            $this->query->orWhere('to_email', 'LIKE', '%'.$value.'%')->orwhereHas('to_user', function ($filter) use ($value) {
                $filter->where([
                    [function ($query) use ($value) {
                        $query->orWhere(\DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', '%'.$value.'%');
                        $query->orWhere('phone_number', 'LIKE', '%'.$value.'%');
                        $query->orWhere('name', 'LIKE', '%'.$value.'%');
                        $query->orWhere('email', 'LIKE', '%'.$value.'%');
                    }],
                ]);
            });
        }
    }
}
