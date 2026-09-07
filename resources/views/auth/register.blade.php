<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name', 'Sentinel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #030712;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            max-width: 1100px;
            background: #030712;
            gap: 50px;
            align-items: center;
        }

        /* Left Gradient Banner */
        .left-banner {
            flex: 1;
            background: linear-gradient(150deg, #1d4ed8 0%, #1e40af 35%, #0f172a 85%, #030712 100%);
            border-radius: 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.08);
            min-height: 580px;
        }

        .left-banner h1 {
            font-size: 38px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .left-banner p {
            font-size: 15px;
            color: #93c5fd;
            max-width: 320px;
            line-height: 1.5;
            opacity: 0.9;
        }

        /* Right Form Container */
        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 460px;
        }

        .form-header {
            margin-bottom: 24px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .form-header p {
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.5;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #cbd5e1;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper svg {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #64748b;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 12px 14px 12px 42px;
            border-radius: 10px;
            color: #f8fafc;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .input-wrapper input::placeholder {
            color: #475569;
        }

        .input-wrapper input:focus {
            border-color: #38edf6;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 12px rgba(56, 237, 246, 0.2);
        }

        /* Action Button */
        .submit-btn {
            width: 100%;
            background: #38edf6;
            color: #031c2e;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 0 20px rgba(56, 237, 246, 0.3);
            margin-top: 8px;
        }

        .submit-btn:hover {
            background: #60f2fa;
            box-shadow: 0 0 26px rgba(56, 237, 246, 0.5);
            transform: translateY(-1px);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #64748b;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .divider span {
            padding: 0 12px;
        }

        /* Social Button */
        .social-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 11px;
            border-radius: 10px;
            color: #f8fafc;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* Footer Redirect Link */
        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #94a3b8;
        }

        .form-footer a {
            color: #38edf6;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: #f87171;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Responsive Layout */
        @media (max-width: 900px) {
            .register-wrapper {
                flex-direction: column;
                gap: 30px;
            }

            .left-banner {
                padding: 40px 20px;
                min-height: auto;
            }

            .right-section {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <main class="main-content">
        <div class="register-wrapper">

            <!-- Left Visual Card -->
            <div class="left-banner">
                <h1>Get Started with Us</h1>
                <p>{{ __('Welcome to RYSE - Let\'s create your account.') }}</p>
            </div>

            <!-- Right Form Section -->
            <div class="right-section">

                <div class="form-header">
                    <h2>{{ __('Sign up account') }}</h2>
                    <p>{{ __('Reclaim control of your data with confidence. Secure, seamless, and built to empower you every step of the way.') }}</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter your full name') }}" required autofocus autocomplete="name">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="error-msg" />
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email address') }}" required autocomplete="username">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="error-msg" />
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input id="password" type="password" name="password" placeholder="{{ __('Create a password') }}" required autocomplete="new-password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="error-msg" />
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Confirm your password') }}" required autocomplete="new-password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="error-msg" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">
                        {{ __('Register') }}
                    </button>
                </form>

                <div class="divider">
                    <span>{{ __('or sign up with') }}</span>
                </div>

                <!-- Google OAuth Button -->
                <button type="button" class="social-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.2 9 5 12 5z"/><path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.6h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.9z"/><path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3s.2-1.6.4-2.3L1.9 7.3C.7 9.7 0 10.8 0 12.5s.7 2.8 1.9 5.2l3.7-2.9z"/><path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.2-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z"/></svg>
                    <span>{{ __('Google') }}</span>
                </button>

                <!-- Login Redirect Link -->
                <div class="form-footer">
                    <p>{{ __('Already registered?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                </div>

            </div>

        </div>
    </main>

    @include('partials.footer')
</body>

</html>