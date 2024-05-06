<?php

namespace App\Http\Resources\LeadManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'collection_agent' => $this->agent->name,
            'package' => $this->interest->product ? $this->interest->product->title : 'NA',
            'last_handled' => $this->interest->last_handled,
            'created_on' => get_date($this->created_at, 'd M Y, h:i a'),
            'status' => $this->status ? $this->status : 'NA',
            'response' => $this->response ? $this->response : 'NA',
            'callback' => $this->callback,
            'callback_on' => $this->callback_on ? get_date($this->callback_on, 'd M Y, h:i a') : 'NA',
        ];
    }
}
