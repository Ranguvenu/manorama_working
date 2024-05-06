<?php

namespace App\Http\Controllers\Integrations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Integration\SSO\SSOSettingsRequest;
use App\Services\MoodleSSOService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MoodleSSOController extends Controller
{
    public function test_connection(SSOSettingsRequest $request)
    {
        try {
            $ssoservice = new MoodleSSOService();
            $validate_settings = $ssoservice->validate_encryption_key_moodle($request->get('lms_url'), $request->get('lms_token'), $request->get('lms_encryption_key'));
            $response = ($validate_settings && isset($validate_settings['data'])) ? $validate_settings['data'] : $validate_settings;
            if (isset($response['errorcode'])) {
                return response()->json([
                    'success' => false,
                    'message' => $response['message'],
                ], 200);
            } else {
                return response()->json($response, 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function login(Request $request, $course = 0)
    {
        $ssoservice = new MoodleSSOService();
        $url = $ssoservice->authenticate_user(\Auth::user(), $course);

        return redirect()->away($url);
    }

    public function logout()
    {
        $ssoservice = new MoodleSSOService();
        $url = $ssoservice->logout_user(\Auth::user());

        return redirect()->away($url);
    }

    public function lms()
    {
        return Inertia::Render('Website/lms');
    }

    public function redirect_on_login()
    {
        return Inertia::Render('Website/redirect');
    }
}
