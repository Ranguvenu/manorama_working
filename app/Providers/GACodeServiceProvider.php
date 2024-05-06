<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SiteSettings;


class GACodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

        $settings = new SiteSettings();
        if($settings){
            \Config::set('settings.theme_ga_code',$settings->theme_ga_code());
        }
    }
}




