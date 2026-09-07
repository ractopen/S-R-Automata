<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Sentinel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #030712;
            color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Flex container pushes footer down natively without fixed heights */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 40px 60px;
        }

        .page-container {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            width: 100%;
            gap: 60px;
        }

        /* Left Side Hero */
        .hero-text {
            flex: 1;
            max-width: 540px;
        }

        .hero-text h1 {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.3;
            color: #f8fafc;
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }

        .hero-subtext {
            font-size: 15px;
            line-height: 1.6;
            color: #94a3b8;
            margin-bottom: 32px;
        }

        /* Feature Highlights */
        .hero-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            font-size: 14px;
            font-weight: 500;
        }

        .feature-badge {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(56, 237, 246, 0.1);
            border: 1px solid rgba(56, 237, 246, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #38edf6;
            flex-shrink: 0;
        }

        /* Right Side Glass Card */
        .login-card {
            flex: 1;
            max-width: 460px;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 44px 38px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        /* Header / Logo */
        .card-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-icon {
            width: 100%;
            height: 52px;
            margin: 0 auto 16px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon img.logo {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .card-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
        }

        .card-header h2 span {
            color: #38edf6;
            background: linear-gradient(90deg, #38edf6, #00b4d8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-header p {
            font-size: 13px;
            color: #94a3b8;
        }

        /* Social Auth Button */
        .social-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 12px;
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

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 22px 0;
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

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #cbd5e1;
            margin-bottom: 8px;
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
            padding: 13px 14px 13px 44px;
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

        /* Options Row */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .remember-me {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #94a3b8;
            cursor: pointer;
            user-select: none;
        }

        .remember-me input[type="checkbox"] {
            accent-color: #38edf6;
            width: 18px;
            height: 18px;
            cursor: pointer;
            border-radius: 4px;
            margin: 0;
        }

        .forgot-pass {
            color: #38edf6;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .forgot-pass:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: #38edf6;
            color: #031c2e;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 0 20px rgba(56, 237, 246, 0.35);
        }

        .submit-btn:hover {
            background: #60f2fa;
            box-shadow: 0 0 28px rgba(56, 237, 246, 0.55);
            transform: translateY(-1px);
        }

        /* Error Text */
        .error-msg {
            color: #f87171;
            font-size: 12px;
            margin-top: 6px;
        }

        .card-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #94a3b8;
        }

        .card-footer a {
            color: #38edf6;
            text-decoration: none;
            font-weight: 600;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }

        /* Mobile & Tablet Responsiveness */
        @media (max-width: 900px) {
            .page-container {
                flex-direction: column;
                justify-content: center;
                gap: 40px;
            }

            .hero-text {
                text-align: center;
                max-width: 100%;
            }

            .hero-text h1 {
                font-size: 28px;
            }

            .hero-features {
                align-items: center;
            }

            .login-card {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <main class="main-content">
        <div class="page-container">

            <!-- Left Column: Hero Text & Feature Highlights -->
            <div class="hero-text">
                <h1>Experience Seamless, Centralized Identity Governance & Real-Time Device Monitoring</h1>
                
                <p class="hero-subtext">
                    Streamline user access, enforce security policies, and maintain full visibility across all enterprise endpoints from a single unified console.
                </p>

                <div class="hero-features">
                    <div class="feature-item">
                        <div class="feature-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <span>Zero-Trust Enterprise Access Control</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <span>Real-Time Endpoint & Device Telemetry</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
                        </div>
                        <span>Automated Role Provisioning</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Glassmorphism Login Card -->
            <div class="login-card">

                <div class="card-header">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                    </div>
                    <h2>{{ __('Welcome to') }} <span>Sentinel</span></h2>
                    <p>{{ __('Sign in to continue to your account') }}</p>
                </div>

                <!-- Session Status Alert -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Google Auth Button -->
                <button type="button" class="social-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.2 9 5 12 5z"/><path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.6h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.9z"/><path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3s.2-1.6.4-2.3L1.9 7.3C.7 9.7 0 10.8 0 12.5s.7 2.8 1.9 5.2l3.7-2.9z"/><path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.2-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z"/></svg>
                    <span>{{ __('Sign in with Google') }}</span>
                </button>

                <div class="divider">
                    <span>{{ __('or continue with email') }}</span>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus autocomplete="username">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="error-msg" />
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input id="password" type="password" name="password" placeholder="{{ __('Enter your password') }}" required autocomplete="current-password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="error-msg" />
                    </div>

                    <!-- Options Row -->
                    <div class="form-options">
                        <label for="remember_me" class="remember-me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span>{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="forgot-pass"
                               onclick="this.href = '{{ route('password.request') }}?email=' + encodeURIComponent(document.getElementById('email').value)">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">
                        {{ __('Sign in') }}
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="card-footer">
                        <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Create one') }}</a></p>
                    </div>
                @endif

            </div>

        </div>
    </main>

    @include('partials.footer')
</body>

</html>