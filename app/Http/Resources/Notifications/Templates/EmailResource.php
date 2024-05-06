<?php

namespace App\Http\Resources\Notifications\Templates;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
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
            'type' => $this->notification_type->title,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'status_name' => $this->status ? 'Active' : 'InActive',
        ];
    }
}
