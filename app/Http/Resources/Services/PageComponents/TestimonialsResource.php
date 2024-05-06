<?php

namespace App\Http\Resources\Services\PageComponents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialsResource extends JsonResource
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
            'name' => $this->name,
            'profileimage' =>  $this->avatar_id ? asset($this->avatar->url) : '',
            'profile' => $this->profile,
            'testimonial' => $this->testimonial,
            'testimonial_type' => $this->testimonial_type,
            'package' => $this->product ? $this->product->title : '',
        ];
    }
}
