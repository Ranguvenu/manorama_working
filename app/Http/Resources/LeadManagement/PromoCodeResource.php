<?php

namespace App\Http\Resources\LeadManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
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
            'code' => $this->code,
            'sent_by' => $this->created_by ? $this->created_by->name : 'NA',
            'sent_on' => get_date($this->created_at, 'd M Y'),
        ];
    }
}
