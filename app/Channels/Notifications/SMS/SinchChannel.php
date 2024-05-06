<?php

namespace App\Channels\Notifications\SMS;

use App\Services\Notifications\SMS\SinchService;
use Illuminate\Notifications\Notification;

class SinchChannel
{
    public function send($notifiable, Notification $notification)
    {
        $service = new SinchService();
        if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }
        $data = $notification->toSinch($notifiable);
        $response = $service->send_sms($to, $data->content);

        return [
            'response' => $response,
            'user' => $data->user,
            'content' => $data->content,
            'template' => $data->template,
        ];
    }
}
