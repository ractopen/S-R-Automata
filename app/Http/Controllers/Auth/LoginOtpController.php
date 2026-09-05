<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginOtpController extends Controller
{
    public function showVerifyForm()
    {
        if (! session()->has('auth.id')) {
            return redirect()->route('login');
        }

        return view('auth.login-otp');
    }

    public function verify(Request $request)
    {
        if (! session()->has('auth.id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = User::find(session('auth.id'));

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->is_ban) {
            session()->forget(['auth.id', 'auth.remember']);
            return redirect()->route('login')->withErrors(['email' => __('Your account has been banned/blocked by an administrator.')]);
        }

        if (!$user->login_otp_expires_at || now()->isAfter($user->login_otp_expires_at)) {
            return back()->withErrors(['otp' => 'This verification code has expired. Please log in again.']);
        }

        if (!Hash::check($request->otp, $user->login_otp)) {
            return back()->withErrors(['otp' => 'The verification code is invalid.']);
        }

        $user->login_otp = null;
        $user->login_otp_expires_at = null;
        $user->save();

        Auth::login($user, session('auth.remember', false));
        $request->session()->regenerate();

        session()->forget(['auth.id', 'auth.remember']);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
