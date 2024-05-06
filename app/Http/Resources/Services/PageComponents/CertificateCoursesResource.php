<?php

namespace App\Http\Resources\Services\PageComponents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateCoursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pricing = $this->pricing()->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '',
            'page' => [
                'slug' => $this->pages ? $this->pages->slug : '',
                'type' => ($this->board && $this->board->path) ? $this->board->path : 'something',
            ],
            'accepting_enrolments' =>  $this->isAcceptingEnrolments(),
            'pricing' => $pricing,
            'rating' => [
                'total' => $this->ratings->count(),
                'average' => round($this->ratings->avg('rating'), 2),
            ],
            'enrolment_starts' => $this->enrollment_start_date
            // 'pricing' => $pricing->map(function ($price) {
            //     return [
            //         'selling_price' => $price->selling_price,
            //         'actual_price' => $price->actual_price,
            //     ];
            // }),
        ];
    }
}
