<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('To complete your registration, please enter the 6-digit verification code sent to your email address:') }}
        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $email }}</span>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register.otp.submit') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Verification Code')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus autocomplete="off" maxlength="6" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button>
                {{ __('Verify & Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-4">
        <form method="POST" action="{{ route('register.otp.resend') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Resend Code') }}
            </button>
        </form>

        <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Back to Register') }}
        </a>
    </div>
</x-guest-layout>
