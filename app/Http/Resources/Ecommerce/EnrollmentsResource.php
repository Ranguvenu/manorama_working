<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentsResource extends JsonResource
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
            'order_id' => $this->order ? $this->order->id : 0,
            'order_key' => $this->order->order_key ? $this->order->order_key : '',
            'fullname' => $this->user->fullname,
            'email' => $this->user->email,
            'packagename' => $this->package ? $this->package->title : '---',
            'courses' => $this->get_courses($this->package_pricing),
            'enrolleddate' => get_date($this->created_at, 'd M Y'),
            'enrolltype' => $this->enrollment_type_name,
            'enrolment_status' => $this->status_name,
        ];
    }

    public function get_courses($pricing)
    {
        $variant = $pricing ? $pricing->courses : [];
        $courses = [];
        if ($variant) {
            $courses = $variant->map(function ($course) {
                return $course->course ? $course->course->title : '';
            })->toArray();
        }

        return implode(',', $courses);
    }
}
