<?php

namespace App\Http\Resources\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageRatingResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user->fullname,
            'rating' => $this->rating,
            'review' => $this->review,
            'avatar' => $this->user->profile ? $this->user->profile->url : '',
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
