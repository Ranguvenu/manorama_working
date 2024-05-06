<?php

namespace App\Listeners;

use App\Notifications\EmailNotification;
use App\Notifications\SinchSMSNotification;
use App\Notifications\SMSCountryNotification;
use App\Services\Notifications\NotificationService;
use Carbon\Carbon;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Notifications\Notification;

class NotificationsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void
    {
        $notification = $event->notification; // Access the notification instance
        $notifiable = $event->notifiable; // Access the notifiable instance (e.g., User)

        // Check if the notification is an instance of EmailNotification
        if ($notification instanceof EmailNotification) {
            $service = new NotificationService($notification->getUser());
            $template = $notification->getTemplate();
            $data = [
                'notification' => [
                    'channel' => $event->channel,
                    'message' => $notification->getContent(),
                    'module' => $notification->getModule(),
                    'to_email' => $notifiable->routeNotificationFor('mail'),
                    'template_id' => $template->id,
                    'subject' => $notification->getSubject(),
                    'notification_type_id' => $template->notification_type->id,
                    'to_user_id' => $notification->getUser() ? $notification->getUser()->id : 0,
                ],
                'log' => [
                    'event' => 'message.queued',
                    'logged_at' => Carbon::now(),
                ],
            ];
            $service->log_notification($data, 'mail');
        } elseif ($notification instanceof SMSCountryNotification) {
            $service = new NotificationService($notification->getUser());
            $response = $event->response['response'];
            $user = $event->response['user'];
            $template = $event->response['template'];
            $data = [
                'notification' => [
                    'message_id' => $response['MessageUUID'],
                    'channel' => $event->channel,
                    'message' => $notification->getContent(),
                    'module' => $notification->getModule(),
                    'to_phone' => $notifiable->routeNotificationFor('sms'),
                    'template_id' => $template->id,
                    'notification_type_id' => $template->notification_type->id,
                    'to_user_id' => $user ? $user->id : 0,
                ],
                'log' => [
                    'event' => 'message.queued',
                    'logged_at' => Carbon::now(),
                ],
            ];
            $service->log_notification($data, 'sms');
        } elseif ($notification instanceof SinchSMSNotification) {
            $service = new NotificationService($notification->getUser());
            $response = $event->response['response'];
            $user = $event->response['user'];
            $template = $event->response['template'];
            $data = [
                'notification' => [
                    'message_id' => $response['respid'],
                    'channel' => $event->channel,
                    'message' => $notification->getContent(),
                    'to_phone' => $notifiable->routeNotificationFor('sms'),
                    'module' => $notification->getModule(),
                    'template_id' => $template->id,
                    'notification_type_id' => $template->notification_type->id,
                    'to_user_id' => $user ? $user->id : 0,
                ],
                'log' => [
                    'event' => 'message.queued',
                    'logged_at' => Carbon::now(),
                ],
            ];
            $service->log_notification($data, 'sms');
        }
    }
}
