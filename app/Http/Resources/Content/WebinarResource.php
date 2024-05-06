<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarResource extends JsonResource
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
            'description' => $this->description,
            'date' => get_date($this->date_time),
            'time' => get_date($this->date_time, 'h:i A'),
            'about' => $this->about_presenter,
            'recording_url' => $this->recording_url,
        ];
    }
}
