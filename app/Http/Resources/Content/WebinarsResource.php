<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarsResource extends JsonResource
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
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '/images/article/article1.png',
            'slug' => $this->slug,
            'published_on' => date('d M Y', strtotime($this->published_on)),
            'status' => $this->status ? 'Published' : 'Draft',
        ];
    }
}
