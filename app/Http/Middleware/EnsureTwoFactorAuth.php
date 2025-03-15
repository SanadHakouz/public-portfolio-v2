<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user doesn't have 2FA enabled, proceed
        if (!$user->hasTwoFactorAuthEnabled()) {
            return $next($request);
        }

        // If 2FA is already verified in this session, proceed
        if ($request->session()->get('auth.two_factor_verified')) {
            return $next($request);
        }

        // Generate and send 2FA code if not already sent
        if (!$request->session()->has('auth.two_factor_code_sent')) {
            $code = $user->generateTwoFactorCode();

            // Send the code via email
            \Illuminate\Support\Facades\Mail::to('sanadhakouz@ymail.com')
                ->send(new \App\Mail\TwoFactorCode($code));

            $request->session()->put('auth.two_factor_code_sent', true);
        }

        // Redirect to 2FA challenge page
        return redirect()->route('two-factor.challenge');
    }
}
