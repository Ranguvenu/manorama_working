<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TFAService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TFAController extends Controller
{
    public function index()
    {
        if (!\Session::has('user_2fa')) {
            return Inertia::render('Auth/TFA');
        }

        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);
        try {
            $service = new TFAService(auth()->user());
            $code = $service->validate_code($request->get('otp'));
            if ($code) {
                \Session::put('user_2fa', auth()->user()->id);

                return redirect()->route('dashboard');
            } else {
                return to_route('2fa.index')->withErrors([
                    'otp' => 'Invalid OTP',
                ]);
            }
        } catch (Exception $e) {
            return to_route('2fa.index')->withErrors([
                'otp' => $e->getMessage(),
            ]);
        }
    }

    public function resend()
    {
        try {
            $service = new TFAService(auth()->user());
            $service->generate_code();

            return Inertia::render('Auth/TFA', ['message' => 'OTP Sent Successfully']);
        } catch (Exception $e) {
            return Inertia::render('Auth/TFA', ['message' => $e->getMessage()]);
        }
    }
}
