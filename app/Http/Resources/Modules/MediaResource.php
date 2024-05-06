<?php

namespace App\Http\Resources\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->mimetype,
            'url' => $this->url,
            'date_created' => $this->created_at->format('M d, Y'),
            'created_at' => $this->created_at,
            'size' => $this->file_size,
            'title' => $this->title,
            'alttext' => $this->alttext,
            'caption' => $this->caption,
            'description' => $this->description,
            'fileurl' => $this->url,
            'media_type' => $this->media_type,
            'extension' => $this->extension,
        ];
    }
}
