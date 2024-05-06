<?php

namespace App\Http\Resources\Services\PageComponents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPostingsResource extends JsonResource
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
            'applied' => \Auth::user() ? $this->application_status(\Auth::user()->id) : false,
            'subject' => $this->subject,
            'slug' => $this->slug,
            'tags' => $this->all_tags,
        ];
    }
}
