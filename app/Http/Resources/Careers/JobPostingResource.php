<?php

namespace App\Http\Resources\Careers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPostingResource extends JsonResource
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
            'category_name' => $this->category ? $this->category->name : 'NA',
            'subject' => $this->subject,
            'publish_from' => $this->publish_from,
            'description' => $this->description,
            'open' => $this->open,
        ];
    }
}
