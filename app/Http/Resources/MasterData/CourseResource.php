<?php

namespace App\Http\Resources\MasterData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'mdl_id' => $this->mdl_id,
            'class' => $this->parent->title,
            'board' => $this->parent->parent->title,
            'goal' => $this->parent->parent->parent->title,
            'title' => $this->title,
            'code' => $this->code,
            'description' => $this->description,
        ];
    }
}
