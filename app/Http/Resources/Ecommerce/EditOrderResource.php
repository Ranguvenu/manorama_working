<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $courses = ($this->package_pricing && $this->package_pricing->courses) ? $this->package_pricing->courses->map(function ($course) {
            return $course->course ? $course->course->title : '';
        })->toArray() : [];
        $batches = ($this->enrollment && $this->enrollment->courses) ? $this->enrollment->courses->map(function ($batch) {
            return $batch->batch ? $batch->batch->name : '';
        })->toArray() : [];

        return [
            'id' => $this->id,
            'user' => $this->user,
            'agent_id' => $this->agent_id,
            'courses' => implode(', ', $courses),
            'batches' => implode(', ', $batches),
            'user_id' => $this->user_id,
            'package' => $this->package,
            'package_id' => $this->package_id,
            // 'courses' => ($this->package_pricing && $this->package_pricing->courses) ? $this->package_pricing->courses->map(function ($course) {
            //     return $course->id;
            // }) : [],
            // 'batches' => ($this->enrollment && $this->enrollment->courses) ? $this->enrollment->courses->map(function ($batch) {
            //     return $batch->id;
            // }) : [],
            'cheque' => $this->transaction_id,
            'status' => $this->status,
        ];
    }
}
