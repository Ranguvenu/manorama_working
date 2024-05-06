<?php

namespace App\Http\Resources\Services\PageComponents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyMaterialsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $badge = [];
        $badge[] = ($this->board ? $this->board->title : '');
        $badge[] = ($this->classes ? $this->classes->title : '');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '/images/article/article1.png',
            'badge' => implode(' > ', $badge),
            'created_on' => get_date($this->created_at, 'F d, Y'),
        ];
    }
}
