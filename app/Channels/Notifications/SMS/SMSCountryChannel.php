<?php

namespace App\Channels\Notifications\SMS;

use App\Services\Notifications\SMS\SMSCountryService;
use Illuminate\Notifications\Notification;

class SMSCountryChannel
{
    public function send($notifiable, Notification $notification)
    {
        $service = new SMSCountryService();
        if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }
        $data = $notification->toSMSCountry($notifiable);
        $response = $service->send_sms($to, $data->content);

        return [
            'response' => $response,
            'user' => $data->user,
            'content' => $data->content,
            'template' => $data->template,
        ];
    }
}
