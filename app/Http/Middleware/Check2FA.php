<?php

namespace App\Http\Middleware;

use App\Services\TFAService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            $service = new TFAService($user);
            if ($service->is_2fa_required()) {
                if (!\Session::has('user_2fa')) {
                    return redirect()->route('2fa.index');
                }
            }
        }

        return $next($request);
    }
}
