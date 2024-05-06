<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
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
            'code' => $this->code,
            'course' => $this->course ? $this->course->name : 'NA',
            'batch_start_date' => get_date($this->batch_start_date, 'd M Y'),
            'batch_end_date' => get_date($this->batch_end_date, 'd M Y'),
            'enrollment_start_date' => get_date($this->enrollment_start_date, 'd M Y'),
            'enrollment_end_date' => get_date($this->enrollment_end_date, 'd M Y'),
            'mdl_course_id' => $this->course ? $this->course->mdl_id : 0,
            'batch_size' => $this->student_limit,
            'batch_duration' => get_date_diff($this->batch_start_date, $this->batch_end_date).' Days',
            'enrollments' => $this->enrollments->count(),
            'is_active' => $this->is_active,
            'batch_provider' => $this->batch_provider ? $this->batch_provider->name : 'NA',
        ];
    }
}
