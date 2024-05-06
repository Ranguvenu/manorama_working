<?php

namespace App\Notifications;

use App\Channels\Notifications\SMS\SMSCountryChannel;
use App\Messages\SMSCountry\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SMSCountryNotification extends Notification
{
    use Queueable;

    protected $template;

    protected $user;

    private $args;

    protected $content;

    protected $subject;

    protected $module;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $template, $args, $module)
    {
        $this->user = $user;
        $this->template = $template;
        $this->content = $template->get_content($args);
        $this->subject = $template->subject;
        $this->module = $module;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SMSCountryChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toSMSCountry($notifiable): SMSMessage
    {
        return (new SMSMessage())
           ->content($this->content)
           ->template($this->template)
           ->user($this->user);
    }

    public function getContent()
    {
        return $this->content;
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
