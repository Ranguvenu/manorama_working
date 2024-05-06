<?php

namespace App\Http\Resources\LeadManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = $this->responses()->latest()->first();

        return [
            'id' => $this->id,
            'name' => $this->leads->name,
            'requested_on' => $this->created_at->format('d M Y, h:i a'),
            'phone' => $this->leads->phone,
            'tags' => $this->tags,
            'caller' => $this->leads->caller,
            'email' => $this->leads->email,
            'interests' => $this->leads->interests->where('category_id', $this->category_id)->count(),
            'source' => $this->source ? $this->source->name : 'NA',
            'package' => $this->product ? $this->product->title : 'NA',
            'status' => $this->status,
            'status_name' => $this->status_name,
            'followup_on' => $response && $response->callback_on != 0 ? get_date($response->callback_on, 'd M Y') : 'NA',
            'response' => $response && $response->response ? $response->response : 'NA',
            'agent' => $this->assignment ? $this->assignment->user->id : 0,
            'agent_name' => $this->assignment ? $this->assignment->user->name : 0,
            'meta' => $this->meta,
            'is_registered' => $this->leads->is_registered,
        ];
    }
}
