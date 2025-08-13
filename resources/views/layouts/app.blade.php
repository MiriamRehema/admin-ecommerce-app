<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">


<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!-- Scripts -->
<wireui:scripts />
<!-- <script src="//unpkg.com/alpinejs" defer></script> -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen antialiased">

<div id="app">

<x-notifications />

<x-notifications position="top-end" />


    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a class="flex items-center text-xl font-semibold text-gray-900 dark:text-white" href="{{ url('/') }}">
                        {{ config('app.name', 'Afrinet') }}
                    </a>
                </div>
                <div class="flex items-center">
                    <ul class="flex space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="text-gray-700 dark:text-gray-200 hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li>
                                    <a class="text-gray-700 dark:text-gray-200 hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            
                            <li class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-gray-700 dark:text-gray-200 hover:underline focus:outline-none">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50">
                                    <a class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-8">
        @yield('content')
    </main>
</div>
@livewireScripts
</body>

</html>