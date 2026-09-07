<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - {{ config('app.name', 'Sentinel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
        }

        body {
            background-color: #030712;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 24px 24px 200px 24px;
        }

        /* Top Bar Branding */
        .brand-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }

        .brand-logo {
            height: 38px;
            object-fit: contain;
        }

        /* Layout Grid */
        .content-grid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            flex: 1;
        }

        /* Left Column - Hero & Step Process */
        .hero-section {
            flex: 1;
            max-width: 520px;
        }

        .hero-title {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.25;
            color: #f8fafc;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .hero-desc {
            font-size: 15px;
            line-height: 1.6;
            color: #cbd5e1; /* High contrast WCAG AA */
            margin-bottom: 36px;
        }

        /* Step List */
        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(56, 237, 246, 0.1);
            border: 1px solid rgba(56, 237, 246, 0.3);
            color: #38edf6;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .step-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #f8fafc;
            margin-bottom: 2px;
        }

        .step-content p {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.4;
        }

        /* Right Column - Glassmorphism Card */
        .card-wrapper {
            flex: 1;
            max-width: 460px;
            width: 100%;
        }

        .form-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 13px;
            color: #cbd5e1;
            margin-bottom: 24px;
            line-height: 1.5;
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
            z-index: 2;
        }

        .input-wrapper input {
            width: 100%;
            background-color: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 13px 14px 13px 44px;
            border-radius: 10px;
            color: #f8fafc;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .input-wrapper input::placeholder {
            color: #64748b;
        }

        .input-wrapper input:focus {
            border-color: #38edf6;
            box-shadow: 0 0 14px rgba(56, 237, 246, 0.25);
            background-color: #1e293b;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: #38edf6;
            color: #031c2e;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 0 18px rgba(56, 237, 246, 0.3);
            margin-top: 4px;
        }

        .submit-btn:hover {
            background: #60f2fa;
            box-shadow: 0 0 24px rgba(56, 237, 246, 0.5);
            transform: translateY(-1px);
        }

        /* Card Footer Link */
        .card-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 24px;
            padding-top: 18px;
            text-align: center;
            font-size: 13px;
        }

        .back-link {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 500;
        }

        .back-link:hover {
            color: #38edf6;
            text-decoration: underline;
        }

        .error-msg {
            color: #f87171;
            font-size: 12px;
            margin-top: 6px;
        }

        @media (max-width: 900px) {
            .content-grid {
                flex-direction: column;
                gap: 36px;
            }

            .hero-section {
                max-width: 100%;
            }

            .card-wrapper {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <main class="main-container">
        <!-- Top Anchor Branding -->
        <header class="brand-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
        </header>

        <div class="content-grid">

            <!-- Left Hero Column: Process Guide -->
            <section class="hero-section">
                <h1 class="hero-title">Trouble signing in?</h1>
                <p class="hero-desc">
                    No problem. Follow our simple 3-step password recovery process to securely regain access to your account.
                </p>

                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Request Code</h4>
                            <p>Provide your registered email address to receive a security verification code.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Verify OTP</h4>
                            <p>Check your inbox and enter the 6-digit one-time password on the next screen.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Set New Password</h4>
                            <p>Choose a safe, updated password and sign back into your account immediately.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Card Column: Request Reset Form -->
            <section class="card-wrapper">
                <div class="form-card">

                    <h2 class="card-title">{{ __('Reset Password') }}</h2>
                    <p class="card-subtitle">{{ __('Enter your email address below and we will send you a 6-digit OTP code.') }}</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email', request()->query('email')) }}" 
                                    placeholder="name@example.com" 
                                    required 
                                    autofocus 
                                    autocomplete="username"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="error-msg" />
                        </div>

                        <button type="submit" class="submit-btn">{{ __('Send OTP Code') }}</button>
                    </form>

                    <!-- Footer Return Link -->
                    <div class="card-footer">
                        <a href="{{ route('login') }}" class="back-link">
                            {{ __('Remember your password? Log in') }}
                        </a>
                    </div>

                </div>
            </section>

        </div>
    </main>

    @include('partials.footer')
</body>

</html>