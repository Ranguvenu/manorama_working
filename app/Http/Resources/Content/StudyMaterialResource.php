<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyMaterialResource extends JsonResource
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
            'author' => $this->author,
            'author_image' => $this->author ? $this->author->profile_image : '',
            'banner_image' => $this->thumbnail ? $this->thumbnail->url : '/images/article/article1.png',
            'slug' =>   $this->slug,
            'description' => $this->description,
            'updated_on' => get_date($this->updated_on),
        ];
    }
}
