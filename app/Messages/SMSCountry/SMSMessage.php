<?php

namespace App\Messages\SMSCountry;

class SMSMessage
{
    public $content;

    public $user;

    public $template;

    public function __construct()
    {
    }

    public function user($user)
    {
        $this->user = $user;

        return $this;
    }

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function template($template)
    {
        $this->template = $template;

        return $this;
    }
}
