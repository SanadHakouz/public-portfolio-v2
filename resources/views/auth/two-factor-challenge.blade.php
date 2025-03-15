<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Two-Factor Authentication</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="pt-6 sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 py-4">
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                            Two-Factor Authentication
                        </h2>

                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Please enter the authentication code sent to your email address.
                        </p>

                        @if (session('status'))
                            <div class="mt-4 p-4 bg-green-100 dark:bg-green-900 rounded">
                                <p class="text-sm text-green-700 dark:text-green-300">
                                    {{ session('status') }}
                                </p>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-4 p-4 bg-red-100 dark:bg-red-900 rounded">
                                @foreach ($errors->all() as $error)
                                    <p class="text-sm text-red-700 dark:text-red-300">
                                        {{ $error }}
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('two-factor.verify') }}" class="mt-6">
                            @csrf

                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Code
                                </label>
                                <input id="code"
                                       type="text"
                                       name="code"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       required
                                       autofocus
                                       autocomplete="one-time-code"
                                       inputmode="numeric"
                                       pattern="[0-9]*">
                            </div>

                            <div class="flex items-center justify-between mt-6">
                                <button type="button"
                                        onclick="event.preventDefault(); document.getElementById('resend-form').submit();"
                                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                                    Resend Code
                                </button>

                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Verify
                                </button>
                            </div>
                        </form>

                        <form id="resend-form" method="POST" action="{{ route('two-factor.resend') }}" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
