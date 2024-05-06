<?php

namespace App\Http\Controllers\Integrations;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\MMHSSOService;
use Illuminate\Http\Request;

class MMHSSOController extends Controller
{
    public function __construct()
    {
        $this->service = new MMHSSOService();
    }

    public function redirect(Request $request)
    {
        $redirect = $this->service->authorize();

        return redirect()->away($redirect);
    }

    public function authenticate(Request $request)
    {
        $user = $this->service->authenticate($request->get('code'));

        if ($user && $user->registration_mode) {
            \Auth::login($user);

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->intended(RouteServiceProvider::LOGIN)->with('error', 'Failed to login');
    }
}
