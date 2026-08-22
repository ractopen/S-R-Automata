<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please enter the 6-digit OTP code sent to your email along with your new password to complete the reset process.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.otp.reset') }}">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-4">
            <x-input-label :value="__('Email Address')" />
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $email }}</p>
        </div>

        <div>
            <x-input-label for="otp" :value="__('OTP Code')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus autocomplete="off" maxlength="6" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-4"
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
                     this.secondsLeft--;
                     if (this.secondsLeft <= 0) {
                         clearInterval(interval);
                         localStorage.removeItem(this.cooldownKey);
                     }
                 }, 1000);
             },
             triggerCooldown() {
                 const expiry = Date.now() + 60 * 1000;
                 localStorage.setItem(this.cooldownKey, expiry.toString());
             }
         }">
        <form method="POST" action="{{ route('password.otp.resend') }}" @submit="triggerCooldown()">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" 
                    x-bind:disabled="secondsLeft > 0"
                    x-bind:class="{ 'opacity-50 cursor-not-allowed': secondsLeft > 0 }"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                <span x-show="secondsLeft <= 0">{{ __('Resend OTP') }}</span>
                <span x-show="secondsLeft > 0" x-text="'Resend OTP (' + secondsLeft + 's)'"></span>
            </button>
        </form>

        <div class="flex items-center space-x-4">
            <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Change Email') }}
            </a>
            
            <span class="text-gray-300 dark:text-gray-700">|</span>

            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</x-guest-layout>
