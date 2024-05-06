<?php

namespace App\Http\Resources\MasterData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClonedCoursesResource extends JsonResource
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
            'mdl_id' => $this->course->mdl_id,
            'goal' => $this->package->goal->title,
            'board' => $this->package->board->title,
            'class' => $this->package->classes->title,
            'packages' => $this->package->title,
            'batches' => $this->course->batch->name,
            'title' => $this->course->name,
            'code' => $this->code,
        ];
    }
}
