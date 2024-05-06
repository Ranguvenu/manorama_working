<?php

namespace App\Http\Middleware;

use App\Helpers\SiteSettings;
use App\Models\MasterData\CountryCode;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = new SiteSettings();

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => function () {
                    return \Auth::user() ? [
                        'id' => \Auth::user()->id,
                        'name' => \Auth::user()->name,
                        'fullname' => \Auth::user()->fullname,
                        'email' => \Auth::user()->email,
                        'avatar' => \Auth::user()->profile,
                        'phone' => \Auth::user()->phone_number,
                        'code' => \Auth::user()->country_code,
                    ] : null;
                },
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
            'permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            'countrycode' => CountryCode::select('name', 'code')->get(),
            'footerlinks' => $settings->footer_links(),
            'theme_settings' => $settings->get_all_theme_settings(),
            'menu_settings' => $settings->menu_settings(),
            'mdl_url' => $settings->lms_url(),
            'previous' => fn () => \URL::previous(),
        ]);
    }
}
