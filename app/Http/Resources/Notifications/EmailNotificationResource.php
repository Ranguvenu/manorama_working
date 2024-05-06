<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailNotificationResource extends JsonResource
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
            'channel' => $this->channel,
            'to_email' => $this->to_email,
            'to_user' => $this->to_user ? $this->to_user->name : 'NA',
            'message' => $this->message,
            'created_at' => get_date($this->created_at, 'd M Y, h:m a'),
        ];
    }
}
