<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SapResource extends JsonResource
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
            'order_key' => $this->order ? $this->order->order_key : '',
            'sap_type_name' => $this->sap_type_name,
            'last_submited_at' => $this->last_submited_at ? get_date_time($this->last_submited_at) : '',
            'status' => $this->status,
            'attempts' => $this->attempts,
        ];
    }
}
