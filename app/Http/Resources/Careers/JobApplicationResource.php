<?php

namespace App\Http\Resources\Careers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
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
            'resume' => $this->resume,
            'user' => $this->user,
            'assignments' => $this->assignments,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'qualification' => $this->qualification,
        ];
    }
}
