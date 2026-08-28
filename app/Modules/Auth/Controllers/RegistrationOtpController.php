<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Auth\Mail\SendRegistrationOtpMail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationOtpController extends Controller
{
    public function showVerifyForm()
    {
        if (! session()->has('register.id')) {
            return redirect()->route('register');
        }

        $user = User::find(session('register.id'));
        if (!$user) {
            return redirect()->route('register');
        }

        return view('Auth::register-otp', [
            'email' => $user->email,
        ]);
    }

    public function verify(Request $request)
    {
        if (! session()->has('register.id')) {
            return redirect()->route('register');
        }

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = User::find(session('register.id'));

        if (!$user) {
            return redirect()->route('register');
        }

        if (!$user->otp_expires_at || now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'This verification code has expired. Please request a new one.']);
        }

        if (!Hash::check($request->otp, $user->otp)) {
            return back()->withErrors(['otp' => 'The verification code is invalid.']);
        }

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        session()->forget('register.id');

        return redirect()->route('dashboard');
    }

    public function resend(Request $request)
    {
        if (! session()->has('register.id')) {
            return redirect()->route('register');
        }

        $user = User::find(session('register.id'));

        if (!$user) {
            return redirect()->route('register');
        }

        $otp = (string) random_int(100000, 999999);

        $user->otp = Hash::make($otp);
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        Mail::to($user->email)->send(new SendRegistrationOtpMail($otp));

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}
