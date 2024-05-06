<?php

namespace App\Http\Resources\Content;

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
            'id'            => $this->id,
            'title'         => $this->title,
            'status'        => $this->is_active ? 'Active' : 'InActive',
	        'valid_from'    => get_date($this->publish_from, 'd M Y'),
            'valid_to'      => get_date($this->publish_to, 'd M Y'),
            'resource_type' => $this->resource_type ? $this->resource_type->name : 'NA',
            'resource_url'  => $this->file ? $this->file->url : '',
            'description'   => $this->description,
        ];
    }
}
