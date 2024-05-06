<?php

namespace App\Providers;

use App\Helpers\SiteSettings as SiteSettingsHelper;
use App\Models\SiteSettings;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\ServiceProvider;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        \App::bind('settings', function () {
            return new SiteSettingsHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(Factory $cache, SiteSettings $settings): void
    {
        if (\Schema::hasTable('site_settings')) {
            $settings = $cache->remember('settings', 100, function () use ($settings) {
                return $settings->pluck('value', 'key');
            });
            config()->set('settings', $settings);
        }
    }
}
