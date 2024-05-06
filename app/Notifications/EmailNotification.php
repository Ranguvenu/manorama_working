<?php

namespace App\Notifications;

use App\Helpers\SiteSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification
{
    use Queueable;

    protected $template;

    protected $user;

    private $args;

    protected $content;

    protected $subject;

    protected $module;

    protected $from_address;

    protected $from_name;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $template, $args, $module)
    {
        $setting = new SiteSettings();
        $this->user = $user;
        $this->template = $template;
        $this->content = $template->get_content($args);
        $this->subject = $template->subject;
        $this->module = $module;
        $this->from_address = ($template && $template->email_setting && $template->email_setting->from_address) ? $template->email_setting->from_address : $setting->email_smtp_from_mail();
        $this->from_name = ($template && $template->email_setting && $template->email_setting->from_name) ? $template->email_setting->from_name : $setting->email_smtp_from_name();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
                ->from($this->from_address, $this->from_name)
                ->subject($this->subject)
                ->markdown('emails.email', ['content' => $this->content]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        ];
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getModule()
    {
        return $this->module;
    }
}
