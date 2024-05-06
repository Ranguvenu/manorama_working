<?php

namespace App\Http\Resources\Services\PageComponents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DownloadableResourcesResource extends JsonResource
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
            'resource' => $this->file ? $this->file->url : '',
            'description' => $this->description,
            'resource_type' => $this->resource_type ? $this->resource_type->name : '',
            'publish_from' => get_date($this->publish_from, 'F d, Y'),
        ];
    }
}
