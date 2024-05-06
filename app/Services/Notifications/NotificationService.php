<?php

namespace App\Services\Notifications;

use App\Helpers\SiteSettings as SiteSettingsHelper;
use App\Models\Notifications\EmailNotification as EmailNotificationModel;
use App\Models\Notifications\NotificationType;
use App\Models\Notifications\SmsNotification;
use App\Models\User;
use App\Notifications\EmailNotification;
use App\Notifications\SinchSMSNotification;
use App\Notifications\SMSCountryNotification;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    private $user;

    private $from;

    private $to_address;

    protected $sms_provider;

    public function __construct(User $user = null, $to_address = '')
    {
        $this->user = $user;
        $this->to_address = $to_address;
        $settings = new SiteSettingsHelper();
        $this->sms_provider = $settings->send_sms_via();
    }

    public function send($type, $method, $args)
    {
        switch ($method) {
            case 'sms':
                $this->send_sms($type, $args);
                break;
            case 'email':
                $this->send_email($type, $args);
                break;
            default:
        }
    }

    public function send_sms($type, $args)
    {
        $template = $this->get_template($type, 'sms');
        $notification_class = '';
        switch ($this->sms_provider) {
            case 'sms_country':
                $notification_class = new SMSCountryNotification($this->user, $template, $args, $type);
                break;
            case 'sms_sinch':
                $notification_class = new SinchSMSNotification($this->user, $template, $args, $type);
                break;
            default:
        }
        if ($notification_class) {
            return $this->user ? $this->user->notify($notification_class) : Notification::route('sms', $this->to_address)->notify($notification_class);
        }

        return false;
    }

    public function send_email($type, $args)
    {
        $template = $this->get_template($type, 'email');
        $recipent = $this->get_recipient($type, 'email');
        $notification_class = new EmailNotification($this->user, $template, $args, $type);

        if ($recipent && isset($recipent['tocustomer']) && $recipent['tocustomer']) {
            return $this->user ? $this->user->notify($notification_class) : Notification::route('mail', $this->to_address)->notify($notification_class);
        } else {
            if ($recipent && isset($recipent['recipient']) && $recipent['recipient']) {
                return Notification::route('mail', $recipent['recipient'])->notify($notification_class);
            }
        }
    }

    public function log_notification($data, $channel)
    {
        if (in_array($channel, ['mail'])) {
            $this->log_email_notification($data);
        } elseif (in_array($channel, ['sms'])) {
            $this->log_sms_notification($data);
        }
    }

    public function log_email_notification($data)
    {
        $emailnotification = EmailNotificationModel::create($data['notification']);
        $emailnotification->email_logs()->create($data['log']);
    }

    public function log_sms_notification($data)
    {
        $smsnotification = SmsNotification::create($data['notification']);
        $smsnotification->sms_logs()->create($data['log']);
    }

    /**
     * @param string $type   [Notification Type]
     * @param string $method [Notification Method]
     *
     * @return bool|object $template
     */
    public function get_template($type, $method)
    {
        $notification = NotificationType::where('slug', $type)->first();
        $template = false;
        switch ($method) {
            case 'sms':
                $template = $notification->sms_settings()->sms_template;
                break;
            case 'email':
                $template = $notification->email_settings()->email_template;
                break;
            default:
                $template = false;
        }

        return $template;
    }

    public function get_recipient($type, $method)
    {
        $notification = NotificationType::where('slug', $type)->first();
        $response = [];
        switch ($method) {
            case 'sms':
                $type = $notification->sms_settings();
                break;
            case 'email':
                $type = $notification->email_settings();
                break;
            default:
                $type = false;
        }

        if ($type) {
            return [
                'tocustomer' => ($type->recipient_type == 'customer') ? true : false,
                'recipient' => $type->recipient,
            ];
        }
    }
}
