<?php

namespace App\Http\Resources\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '',
        ];
    }
}
