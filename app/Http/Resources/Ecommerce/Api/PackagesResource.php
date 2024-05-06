<?php

namespace App\Http\Resources\Ecommerce\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $page = $this->pages ? $this->pages->slug : '';
        if ($page) {
            $pagetype = ($this->board && $this->board->path) ? $this->board->path : 'something';
            $marketingpage = route('frontend.package', ['page' => $page, 'type' => $pagetype]);
        }

        return [
            'id' => $this->id,
            'page' => $page ? $marketingpage : '',
            'title' => $this->title,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '',
            'pricing' => $this->pricing->map(function ($price) {
                return [
                    'actual_price' => $price->actual_price,
                    'selling_price' => $price->selling_price,
                ];
            }),
            'valid_from' => get_date($this->valid_from),
            'valid_to' => get_date($this->valid_to),
        ];
    }
}
