<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SmsNotificationResource extends JsonResource
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
            'message_id' => $this->message_id,
            'to_phone' => $this->to_phone,
            'message' => $this->message,
            'channel' => $this->channel_name,
            'module' => $this->module,
            'to_user' => $this->to_user ? $this->to_user->name : 'NA',
            'created_by' => $this->created_by ? $this->created_by->name : 'NA',
            'event' => $this->latest_sms_log ? $this->latest_sms_log->event : 'NA',
            'logs' => $this->sms_logs,
        ];
    }
}
