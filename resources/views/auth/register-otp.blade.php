<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Security Code - {{ config('app.name', 'Sentinel') }}</title>
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

        /* Left Column - Instructions & Visual Balance */
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
            color: #cbd5e1; /* Increased contrast for WCAG AA */
            margin-bottom: 36px;
        }

        /* Instructional Steps List */
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

        /* Right Column - Glassmorphism Form Card */
        .card-wrapper {
            flex: 1;
            max-width: 460px;
            width: 100%;
        }

        .otp-card {
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
        }

        /* Email Badge with Quick Edit Action */
        .email-display-badge {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 10px 14px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
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

        .edit-email-btn {
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

        .edit-email-btn:hover {
            background: rgba(56, 237, 246, 0.15);
            color: #38edf6;
            border-color: rgba(56, 237, 246, 0.3);
        }

        /* Segmented 6-Digit Input Grid */
        .otp-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
            margin-bottom: 24px;
        }

        .otp-cell {
            width: 100%;
            height: 52px;
            text-align: center;
            font-size: 20px;
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

        /* Submit CTA */
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
        }

        .submit-btn:hover {
            background: #60f2fa;
            box-shadow: 0 0 24px rgba(56, 237, 246, 0.5);
            transform: translateY(-1px);
        }

        /* Action Divider & Resend Link */
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

        .back-link {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #f8fafc;
            text-decoration: underline;
        }

        .error-msg {
            color: #f87171;
            font-size: 12px;
            margin-bottom: 16px;
            text-align: center;
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

            <!-- Left Hero Column: Context & Instructional Guidance -->
            <section class="hero-section">
                <h1 class="hero-title">Check your email for the security code</h1>
                <p class="hero-desc">
                    We've sent a 6-digit one-time password to verify your account registration and prevent unauthorized access.
                </p>

                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Open your inbox</h4>
                            <p>Look for an email from {{ config('app.name', 'Sentinel') }} with your verification code.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Enter the code</h4>
                            <p>Input the 6 digits in the verification form on the right.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Didn't get the email?</h4>
                            <p>Check your spam or junk folder if the code doesn't arrive within 60 seconds.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Card Column: Segmented OTP Form -->
            <section class="card-wrapper">
                <div class="otp-card">

                    <h2 class="card-title">Enter Verification Code</h2>
                    <p class="card-subtitle">Complete registration by entering your code below.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Editable Email Badge -->
                    <div class="email-display-badge">
                        <div class="email-info">
                            <span class="email-label">Code Sent To</span>
                            <span class="email-value">{{ session('email', $email ?? 'mavy@yahoo.com') }}</span>
                        </div>
                        <a href="{{ route('register') }}" class="edit-email-btn">Edit Email</a>
                    </div>

                    <!-- OTP Form Component -->
                    <form method="POST" action="{{ route('register.otp.verify') }}">
                        @csrf

                        <!-- Segmented Input Logic -->
                        <div x-data="{
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
                            
                            <!-- Hidden input carrying final value for backend submit -->
                            <input type="hidden" name="otp" :value="digits.join('')" required>

                            <!-- Segmented Cells -->
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
                                        autocomplete="one-time-code"
                                    >
                                </template>
                            </div>
                        </div>

                        <x-input-error :messages="$errors->get('otp')" class="error-msg" />

                        <button type="submit" class="submit-btn">Verify & Complete Setup</button>
                    </form>

                    <!-- Resend & Back Action Footer -->
                    <div class="card-footer"
                         x-data="{
                             cooldownKey: 'reg_otp_cooldown',
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

                        <form method="POST" action="{{ route('register.otp.resend') }}" @submit="triggerCooldown()">
                            @csrf
                            <button type="submit" class="resend-btn" :disabled="secondsLeft > 0">
                                <span x-show="secondsLeft <= 0">Resend Code</span>
                                <span x-show="secondsLeft > 0" x-text="'Resend in ' + formatTimer(secondsLeft)"></span>
                            </button>
                        </form>

                        <a href="{{ route('register') }}" class="back-link">Back to Register</a>
                    </div>

                </div>
            </section>

        </div>
    </main>

    @include('partials.footer')
</body>

</html>