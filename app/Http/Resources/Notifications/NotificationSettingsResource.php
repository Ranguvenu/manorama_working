<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationSettingsResource extends JsonResource
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
            'title' => $this->title,
            'method' => $this->method,
            'recipient' => $this->recipient,
            'from_address' => $this->from_address,
            'from_name' => $this->from_name,
            'template_name' => $this->template_name,
        ];
    }
}
