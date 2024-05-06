<?php

namespace App\Utilities\Modules\Media;

use App\Contracts\FilterContract;

class Type implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        if ($value > -1) {
            $mimes = $this->get_mime_types($value);
            // print_r($mimes);
            // Your filtering logic goes here
            if (!empty($mimes)) {
                $this->query->whereIn('type', $mimes);
            }
        }
    }

    public function get_mime_types($type)
    {
        $filters = [];
        switch ($type) {
            case 'images':
                $filters = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/svg', 'image/svg+xml'];
                break;
            case 'pdfs':
                $filters = ['application/pdf'];
                break;
            case 'videos':
                $filters = ['video/mp4'];
                break;
            default:
        }

        return $filters;
    }
}
