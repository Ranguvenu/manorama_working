<?php

namespace App\Helpers;

class SiteSettings
{
    public function __construct()
    {
        $this->settings = config('settings') ? (object) config('settings') : '';
    }

    public function settings()
    {
        return $this->settings;
    }

    public function get_setting($setting)
    {
        return isset($this->settings[$setting]) ? $this->settings[$setting] : false;
    }

    public function lms_token()
    {
        return $this->get_setting('lms_token');
    }

    public function lms_url()
    {
        return $this->get_setting('lms_url');
    }

    public function lms_encryption_key()
    {
        return $this->get_setting('lms_encryption_key');
    }

    public function email_smtp_host()
    {
        return $this->get_setting('email_smtp_host');
    }

    public function email_smtp_port()
    {
        return $this->get_setting('email_smtp_port');
    }

    public function email_smtp_username()
    {
        return $this->get_setting('email_smtp_username');
    }

    public function email_smtp_password()
    {
        return $this->get_setting('email_smtp_password');
    }

    public function email_smtp_from_mail()
    {
        return $this->get_setting('email_smtp_from_mail');
    }

    public function email_smtp_from_name()
    {
        return $this->get_setting('email_smtp_from_name');
    }

    public function email_smtp_encryption()
    {
        return $this->get_setting('email_smtp_encryption');
    }

    public function send_sms_via()
    {
        return $this->get_setting('send_sms_via');
    }

    public function sinch_api_token()
    {
        return $this->get_setting('sinch_api_token');
    }

    public function sinch_from_number()
    {
        return $this->get_setting('sinch_from_number');
    }

    public function sinch_plan_id()
    {
        return $this->get_setting('sinch_plan_id');
    }

    public function sms_country_auth_key()
    {
        return $this->get_setting('sms_country_auth_key');
    }

    public function sms_country_auth_token()
    {
        return $this->get_setting('sms_country_auth_token');
    }

    public function sms_country_sender_id()
    {
        return $this->get_setting('sms_country_sender_id');
    }

    public function footer_links()
    {
        return $this->get_setting('footer_links');
    }

    public function theme_ga_code()
    {
        return $this->get_setting('theme_ga_code');
    }

    public function get_all_theme_settings()
    {
        return [
            'facebook' => $this->get_setting('theme_facebook'),
            'instagram' => $this->get_setting('theme_instagram'),
            'youtube' => $this->get_setting('theme_youtube'),
            'linkedid' => $this->get_setting('theme_linkedin'),
            'pininterest' => $this->get_setting('theme_pininterest'),
            'secondaryfooter_content' => $this->get_setting('theme_secondaryfooter_content'),
            'contactemail' => $this->get_setting('theme_contactemail'),
            'contactphone' => $this->get_setting('theme_contactphone'),
        ];
    }

    public function payment_razorpay_key_id()
    {
        return $this->get_setting('payment_razorpay_key_id');
    }

    public function payment_razorpay_key_secret()
    {
        return $this->get_setting('payment_razorpay_key_secret');
    }

    public function menu_settings()
    {
        return $this->get_setting('menu');
    }

    public function blog_sidebar()
    {
        return $this->get_setting('sidebar');
    }
}
