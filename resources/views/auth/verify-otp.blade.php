<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - {{ config('app.name', 'Sentinel') }}</title>
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
            padding: 24px 24px 40px 24px;
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

        /* Left Column - Security Guidance */
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

        /* Security Checklist */
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

        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(56, 237, 246, 0.1);
            border: 1px solid rgba(56, 237, 246, 0.3);
            color: #38edf6;
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
            max-width: 480px;
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
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* Email Badge with Quick Change Action */
        .email-display-badge {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 10px 14px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .email-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
            overflow: hidden;
            padding-right: 12px;
        }

        .email-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            font-weight: 600;
        }

        .email-value {
            font-size: 13px;
            color: #38edf6;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .change-email-btn {
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s;
            white-space: nowrap;
        }

        .change-email-btn:hover {
            background: rgba(56, 237, 246, 0.15);
            color: #38edf6;
            border-color: rgba(56, 237, 246, 0.3);
        }

        /* Segmented 6-Digit OTP Box */
        .otp-section {
            margin-bottom: 20px;
        }

        .otp-label {
            display: block;
            font-size: 13px;
            color: #cbd5e1;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .otp-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
        }

        .otp-cell {
            width: 100%;
            height: 48px;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #38edf6;
            background-color: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            outline: none;
            transition: all 0.2s ease;
        }

        .otp-cell:focus {
            border-color: #38edf6;
            box-shadow: 0 0 12px rgba(56, 237, 246, 0.3);
            background-color: #1e293b;
        }

        .otp-cell:not(:placeholder-shown) {
            border-color: rgba(56, 237, 246, 0.5);
        }

        /* Form Input Controls */
        .form-group {
            margin-bottom: 18px;
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
            padding: 12px 14px 12px 44px;
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
            margin-top: 6px;
        }

        .submit-btn:hover {
            background: #60f2fa;
            box-shadow: 0 0 24px rgba(56, 237, 246, 0.5);
            transform: translateY(-1px);
        }

        /* Action Divider & Links */
        .card-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 24px;
            padding-top: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
        }

        .resend-btn {
            background: transparent;
            border: none;
            color: #38edf6;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            padding: 0;
        }

        .resend-btn:hover:not(:disabled) {
            text-decoration: underline;
        }

        .resend-btn:disabled {
            color: #64748b;
            cursor: not-allowed;
            text-decoration: none;
        }

        .cancel-link {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 500;
        }

        .cancel-link:hover {
            color: #f8fafc;
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

            <!-- Left Hero Column: Security Recommendations -->
            <section class="hero-section">
                <h1 class="hero-title">Create a strong, new password</h1>
                <p class="hero-desc">
                    Enter the verification code sent to your email along with a new secure password to restore access to your account.
                </p>

                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <div class="step-content">
                            <h4>Use at least 8 characters</h4>
                            <p>Combine uppercase and lowercase letters, numbers, and symbols for best security.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div class="step-content">
                            <h4>Avoid reused passwords</h4>
                            <p>Make sure your new password is unique and not shared with other online services.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div class="step-content">
                            <h4>Instant Session Reset</h4>
                            <p>Once submitted, your old password will be invalidated immediately across all devices.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Card Column: Reset Form -->
            <section class="card-wrapper">
                <div class="form-card">

                    <h2 class="card-title">{{ __('Reset Password') }}</h2>
                    <p class="card-subtitle">{{ __('Enter your 6-digit OTP code and choose your new password.') }}</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Editable Email Badge -->
                    <div class="email-display-badge">
                        <div class="email-info">
                            <span class="email-label">{{ __('Target Account') }}</span>
                            <span class="email-value">{{ $email }}</span>
                        </div>
                        <a href="{{ route('password.request') }}" class="change-email-btn">{{ __('Change Email') }}</a>
                    </div>

                    <!-- OTP Reset Form -->
                    <form method="POST" action="{{ route('password.otp.reset') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- Segmented OTP Input Grid -->
                        <div class="otp-section" 
                             x-data="{
                                digits: ['', '', '', '', '', ''],
                                init() {
                                    $nextTick(() => { this.$refs.digit0.focus(); });
                                },
                                handleInput(e, index) {
                                    const val = e.target.value.replace(/\D/g, '');
                                    this.digits[index] = val ? val.slice(-1) : '';
                                    if (val && index < 5) {
                                        this.$refs['digit' + (index + 1)].focus();
                                    }
                                },
                                handleKeydown(e, index) {
                                    if (e.key === 'Backspace') {
                                        if (!this.digits[index] && index > 0) {
                                            this.$refs['digit' + (index - 1)].focus();
                                        } else {
                                            this.digits[index] = '';
                                        }
                                    } else if (e.key === 'ArrowLeft' && index > 0) {
                                        this.$refs['digit' + (index - 1)].focus();
                                    } else if (e.key === 'ArrowRight' && index < 5) {
                                        this.$refs['digit' + (index + 1)].focus();
                                    }
                                },
                                handlePaste(e) {
                                    e.preventDefault();
                                    const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                                    if (pasted) {
                                        for (let i = 0; i < 6; i++) {
                                            this.digits[i] = pasted[i] || '';
                                        }
                                        const nextFocus = Math.min(pasted.length, 5);
                                        this.$refs['digit' + nextFocus].focus();
                                    }
                                }
                             }">

                            <label class="otp-label">{{ __('OTP Security Code') }}</label>
                            
                            <!-- Hidden input carrying final value for backend submission -->
                            <input type="hidden" name="otp" :value="digits.join('')" required>

                            <div class="otp-grid" @paste="handlePaste($event)">
                                <template x-for="(digit, i) in 6" :key="i">
                                    <input 
                                        type="text" 
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        maxlength="1"
                                        placeholder="•"
                                        class="otp-cell"
                                        x-model="digits[i]"
                                        :x-ref="'digit' + i"
                                        @input="handleInput($event, i)"
                                        @keydown="handleKeydown($event, i)"
                                        autocomplete="off"
                                    >
                                </template>
                            </div>
                            <x-input-error :messages="$errors->get('otp')" class="error-msg" />
                        </div>

                        <!-- New Password Field -->
                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.778-7.778zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                                </svg>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    placeholder="{{ __('Enter new password') }}" 
                                    required 
                                    autocomplete="new-password"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="error-msg" />
                        </div>

                        <!-- Confirm New Password Field -->
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                                <input 
                                    id="password_confirmation" 
                                    type="password" 
                                    name="password_confirmation" 
                                    placeholder="{{ __('Confirm new password') }}" 
                                    required 
                                    autocomplete="new-password"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="error-msg" />
                        </div>

                        <button type="submit" class="submit-btn">{{ __('Reset Password') }}</button>
                    </form>

                    <!-- Resend & Navigation Footer -->
                    <div class="card-footer"
                         x-data="{
                             cooldownKey: 'reset_otp_cooldown',
                             secondsLeft: 0,
                             init() {
                                 const expiry = localStorage.getItem(this.cooldownKey);
                                 if (expiry) {
                                     const diff = Math.ceil((parseInt(expiry) - Date.now()) / 1000);
                                     if (diff > 0) {
                                         this.secondsLeft = diff;
                                         this.startTimer();
                                     }
                                 }
                             },
                             startTimer() {
                                 let interval = setInterval(() => {
                                     if (--this.secondsLeft <= 0) {
                                         clearInterval(interval);
                                         localStorage.removeItem(this.cooldownKey);
                                     }
                                 }, 1000);
                             },
                             triggerCooldown() {
                                 localStorage.setItem(this.cooldownKey, (Date.now() + 60000).toString());
                             },
                             formatTimer(sec) {
                                 const m = Math.floor(sec / 60);
                                 const s = sec % 60;
                                 return `${m}:${s < 10 ? '0' : ''}${s}`;
                             }
                         }">

                        <form method="POST" action="{{ route('password.otp.resend') }}" @submit="triggerCooldown()">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="resend-btn" :disabled="secondsLeft > 0">
                                <span x-show="secondsLeft <= 0">{{ __('Resend OTP') }}</span>
                                <span x-show="secondsLeft > 0" x-text="'Resend in ' + formatTimer(secondsLeft)"></span>
                            </button>
                        </form>

                        <a href="{{ route('login') }}" class="cancel-link">{{ __('Cancel') }}</a>
                    </div>

                </div>
            </section>

        </div>
    </main>

    @include('partials.footer')
</body>

</html> 