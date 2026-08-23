<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Sean') }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Registered Users Information') }}</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                                    <th class="py-3 px-4 font-semibold">{{ __('Name') }}</th>
                                    <th class="py-3 px-4 font-semibold">{{ __('Email') }}</th>
                                    <th class="py-3 px-4 font-semibold text-center">{{ __('Admin Status') }}</th>
                                    <th class="py-3 px-4 font-semibold text-center">{{ __('Account Status') }}</th>
                                    <th class="py-3 px-4 font-semibold text-center">{{ __('Email Verification') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="py-3 px-4">{{ $user->name }}</td>
                                        <td class="py-3 px-4">{{ $user->email }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $user->is_admin ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                {{ $user->is_admin ? __('Administrator') : __('Standard User') }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $user->is_ban ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                                {{ $user->is_ban ? __('Banned') : __('Active') }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-center text-sm">
                                            @if ($user->email_verified_at)
                                                <span class="text-green-600 dark:text-green-400 font-medium">
                                                    {{ __('Verified') }}
                                                </span>
                                            @else
                                                <span class="text-gray-500 dark:text-gray-400">
                                                    {{ __('Pending') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
