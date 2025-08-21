<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <wireui:scripts />
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen antialiased">
     

<div id="app">
    <x-notifications />
    <x-notifications position="top-end" />

    
 @livewire('partials.navbar')
    <main class="py-8">
       @yield('content')
    </main>
@livewire('partials.footer')
</div>

@livewireScripts
</body>
</html>
