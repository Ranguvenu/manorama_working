<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditPackageResource extends JsonResource
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
            'subjects' => $this->courses()->pluck('course_id'),
            'validity_type' => $this->validity_type,
            'valid_for' => ($this->validity_type == 'days') ? $this->valid_for : date('Y-m-d', strtotime($this->valid_for)),
            'thumbnail_id' => $this->thumbnail_id,
            'title' => $this->title,
            'description' => $this->description,
            'valid_from' => date('Y-m-d', strtotime($this->valid_from)),
            'valid_to' => date('Y-m-d', strtotime($this->valid_to)),
            'enrollment_start_date' => date('Y-m-d', strtotime($this->enrollment_start_date)),
            'enrollment_end_date' => date('Y-m-d', strtotime($this->enrollment_end_date)),
            'package_type' => $this->package_type,
            'is_external_course' => $this->is_external_course,
            'instructions' => $this->instructions,
            'is_paid' => $this->is_paid,
            'is_trial_available' => $this->is_trial_available,
            'is_published' => $this->is_published,
            'haspage' => $this->pages ? true : false,
            'page_id' => $this->pages ? $this->pages->id : 0,
            'page' => [
                'page' => $this->pages ? $this->pages->slug : '',
                'type' => $this->board ? $this->board->path : 'something',
            ],
        ];
    }
}
