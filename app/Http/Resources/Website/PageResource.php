<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'page_type' => $this->page_type,
            'package' => $this->package ? $this->package->board->path : 'course',
            'package_id' => $this->package_id,
            'author' => $this->user_created->name,
            'status_name' => $this->status_name,
            'status' => $this->status,
            'date' => get_date($this->created_at, 'd M Y, h:m a'),
        ];
    }
}
