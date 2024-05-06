<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchEnrollmentsResource extends JsonResource
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
            'order_key' => $this->enrollment->order ? $this->enrollment->order->order_key : 'NA',
            'firstname' => $this->enrollment->user ? $this->enrollment->user->firstname : 'NA',
            'lastname' => $this->enrollment->user ? $this->enrollment->user->lastname : 'NA',
            'email' => $this->enrollment->user ? $this->enrollment->user->email : 'NA',
            'created_on' => get_date($this->enrollment->created_at),
        ];
    }
}
