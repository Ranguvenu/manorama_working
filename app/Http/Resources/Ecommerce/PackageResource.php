<?php

namespace App\Http\Resources\Ecommerce;

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
            'goal_id' => $this->goal_id,
            'board_id' => $this->board_id,
            'class_id' => $this->class_id,
            'code' => $this->code,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '',
            'courses' => $this->courses->map(function ($course) {
                return [
                    'id' => $course->id,
                    'course_title' => $course->course->title,
                    'course_code' => $course->course->code,
                    'batches' => BatchResource::collection($course->batches),
                ];
            }),
            'validity_type' => $this->validity_type,
            'valid_for' => $this->valid_for,
            'thumbnail_id' => $this->thumbnail_id,
            'title' => $this->title,
            'description' => $this->description,
            'valid_from' => date('d M Y', strtotime($this->valid_from)),
            'valid_to' => date('d M Y', strtotime($this->valid_to)),
            'package_type_name' => $this->package_type_name,
            'is_paid' => $this->is_paid,
            'is_trial_available' => $this->is_trial_available,
            'is_published' => $this->is_published,
        ];
    }
}
