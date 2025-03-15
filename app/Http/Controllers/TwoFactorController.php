<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorCode as TwoFactorCodeMail;
use App\Models\TwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA verification form.
     */
    public function index()
    {
        return view('auth.two-factor-challenge');
    }

    /**
     * Send a new two-factor authentication code.
     */
    public function send(Request $request)
    {
        $user = $request->user();

        // Generate a new code
        $code = $user->generateTwoFactorCode();

        // Send the code via email
        Mail::to('sanadhakouz@ymail.com')->send(new TwoFactorCodeMail($code));

        return back()->with('status', 'We sent you a two-factor authentication code.');
    }

    /**
     * Verify the two-factor authentication code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = $request->user();
        $code = $request->input('code');

        // Log for debugging
        Log::info('2FA Code Verification', [
            'user_id' => $user->id,
            'entered_code' => $code,
        ]);

        // Get the latest valid code
        $validCode = TwoFactorCode::getValidCode($user->id);

        // Log more info
        Log::info('2FA Valid Code Check', [
            'valid_code_exists' => $validCode ? 'yes' : 'no',
            'valid_code' => $validCode ? $validCode->code : null,
            'code_match' => $validCode && $validCode->code === $code ? 'yes' : 'no'
        ]);

        if (!$validCode || $validCode->code !== $code) {
            return back()->withErrors([
                'code' => 'The two-factor authentication code you have entered is invalid.',
            ]);
        }

        // Mark the code as used
        $validCode->markAsUsed();

        // Store in session that 2FA is complete
        $request->session()->put('auth.two_factor_verified', true);

        // Redirect to intended destination with correct route name
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Resend the two-factor authentication code.
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        // Generate a new code
        $code = $user->generateTwoFactorCode();

        // Log the new code for debugging
        Log::info('2FA Code Resent', [
            'user_id' => $user->id,
            'new_code' => $code
        ]);

        // Send the code via email
        Mail::to('sanadhakouz@ymail.com')->send(new TwoFactorCodeMail($code));

        return back()->with('status', 'We sent you a new two-factor authentication code.');
    }
}
