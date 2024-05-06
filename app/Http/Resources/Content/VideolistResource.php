<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideolistResource extends JsonResource
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
            'video' => $this->video,
            'thumbnail' => $this->thumbnail,
            'published_from' => $this->published_from,
            'published_to' => $this->published_to,
          ];
    }
}
