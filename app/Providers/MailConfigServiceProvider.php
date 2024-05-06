<?php

namespace App\Providers;

use App\Helpers\SiteSettings;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = new SiteSettings();
        if ($settings) {
            $config = [
                'driver' => 'smtp',
                'host' => $settings->email_smtp_host(),
                'port' => $settings->email_smtp_port(),
                'from' => [
                    'address' => $settings->email_smtp_from_mail(),
                    'name' => $settings->email_smtp_from_name(),
                ],
                'encryption' => $settings->email_smtp_encryption(),
                'username' => $settings->email_smtp_username(),
                'password' => $settings->email_smtp_password(),
                'pretend' => false,
            ];
            \Config::set('mail', $config);
        }
    }
}
