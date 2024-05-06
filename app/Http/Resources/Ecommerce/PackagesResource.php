<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'haspage' => $this->pages ? true : false,
            'page_id' => $this->pages ? $this->pages->id : 0,
            'page' => [
                'page' => $this->pages ? $this->pages->slug : '',
                'type' => ($this->board && $this->board->path) ? $this->board->path : 'something',
            ],
            'valid_from' => get_date($this->valid_from),
            'valid_to' => get_date($this->valid_to),
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '',
            'total_courses' => $this->courses->count(),
            'payment_type' => $this->payment_type_name,
            'package_type' => $this->package_type_name,
            'validity_type' => $this->validity_type,
            'validity_value' => $this->valid_for,
            'published' => $this->is_published ? true : false,
        ];
    }
}
