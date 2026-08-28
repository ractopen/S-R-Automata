<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-100">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg dark:bg-red-800 dark:text-red-100">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">{{ __('All Active Users') }}</h3>
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
                                    @if (Auth::user()?->is_admin)
                                        <th class="py-3 px-4 font-semibold">{{ __('Created By') }}</th>
                                    @endif
                                    <th class="py-3 px-4 font-semibold text-center">{{ __('Role') }}</th>
                                    <th class="py-3 px-4 font-semibold text-center">{{ __('Status') }}</th>
                                    <th class="py-3 px-4 font-semibold text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="py-3 px-4">{{ $user->name }}</td>
                                        <td class="py-3 px-4">{{ $user->email }}</td>
                                        @if (Auth::user()?->is_admin)
                                            <td class="py-3 px-4 text-sm">
                                                @if ($user->created_by === null)
                                                    <span class="italic text-gray-400 dark:text-gray-500">{{ __('System / Independent') }}</span>
                                                @else
                                                    {{ $user->creator?->name ?? __('Unknown') }}
                                                @endif
                                            </td>
                                        @endif
                                        <td class="py-3 px-4 text-center">
                                            @if ($user->is_admin)
                                                @if (Auth::user()?->is_admin && $user->id !== Auth::id())
                                                    <form method="POST" action="{{ route('users.toggle-admin', $user) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 hover:bg-purple-200">
                                                            {{ __('Super Admin') }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                        {{ __('Super Admin') }}
                                                    </span>
                                                @endif
                                            @elseif ($user->created_by === null)
                                                @if (Auth::user()?->is_admin)
                                                    <form method="POST" action="{{ route('users.toggle-admin', $user) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 hover:bg-blue-200">
                                                            {{ __('Manager') }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        {{ __('Manager') }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ __('Sub-User') }}
                                                </span>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
