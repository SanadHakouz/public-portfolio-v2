<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginAttempt;

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Record the login attempt
    $loginAttempt = [
        'email' => $request->email,
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
        'successful' => false, // Will update this if login is successful
    ];

    $attempt = LoginAttempt::create($loginAttempt);

    // Attempt to log the user in
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Update the login attempt record to successful
        $attempt->update(['successful' => true]);

        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    // If we get here, login failed
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
