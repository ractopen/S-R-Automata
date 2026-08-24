<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Mail\SendLoginOtpMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = User::where('email', $request->email)->first();

        $otp = (string) rand(100000, 999999);

        $user->login_otp = Hash::make($otp);
        $user->login_otp_expires_at = now()->addMinutes(15);
        $user->save();

        Mail::to($user->email)->send(new SendLoginOtpMail($otp));

        session([
            'auth.id' => $user->id,
            'auth.remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('login.otp.verify');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->has('redirect_to')) {
            return redirect($request->input('redirect_to'));
        }

        return redirect('/');
    }
}
