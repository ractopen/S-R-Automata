<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-100">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-red-100 text-red-800 rounded-lg dark:bg-red-800 dark:text-red-100">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome back, ') }} <strong>{{ Auth::user()->name }}</strong>!
                </div>
            </div>

            @if (Auth::user()->is_admin)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium">{{ __('User Management') }}</h3>
                            <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                                {{ __('Create New User') }}
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                                        <th class="py-3 px-4 font-semibold">{{ __('Name') }}</th>
                                        <th class="py-3 px-4 font-semibold">{{ __('Email') }}</th>
                                        <th class="py-3 px-4 font-semibold">{{ __('Created By') }}</th>
                                        <th class="py-3 px-4 font-semibold text-center">{{ __('Role') }}</th>
                                        <th class="py-3 px-4 font-semibold text-center">{{ __('Status') }}</th>
                                        <th class="py-3 px-4 font-semibold text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                            <td class="py-3 px-4">{{ $user->name }}</td>
                                            <td class="py-3 px-4">{{ $user->email }}</td>
                                            <td class="py-3 px-4 text-sm">
                                                @if ($user->created_by === null)
                                                    <span class="italic text-gray-400 dark:text-gray-500">{{ __('System / Independent') }}</span>
                                                @else
                                                    {{ $user->creator?->name ?? __('Unknown') }}
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                @if ($user->is_admin)
                                                    @if (Auth::user()?->is_admin && $user->id !== Auth::id())
                                                        <form method="POST" action="{{ route('users.toggle-admin', $user) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 hover:bg-purple-200" title="{{ __('Click to demote to User') }}">
                                                                {{ __('Admin') }}
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                            {{ __('Admin') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    @if (Auth::user()?->is_admin)
                                                        <form method="POST" action="{{ route('users.toggle-admin', $user) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 hover:bg-purple-100 hover:text-purple-800 dark:hover:bg-purple-900 dark:hover:text-purple-200" title="{{ __('Click to promote to Admin') }}">
                                                                {{ __('User') }}
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                            {{ __('User') }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <form method="POST" action="{{ route('users.toggle-block', $user) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1 rounded text-xs font-semibold {{ $user->is_ban ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                                        {{ $user->is_ban ? __('Blocked') : __('Active') }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="py-3 px-4 text-right space-x-2">
                                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 text-sm font-medium">
                                                    {{ __('Edit/Reset') }}
                                                </a>
                                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to archive and delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 text-sm font-medium">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-6 px-4 text-center text-gray-500 dark:text-gray-400">
                                                {{ __('No registered users found.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
