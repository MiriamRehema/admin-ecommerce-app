<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
  
    
     @livewireScripts
    
</head>
<body class="bg-gray-50 dark:bg-green-700 min-h-screen antialiased">
    <div id="app" class="flex">
        <!-- Sidebar -->
        <div x-data="{ open: true }" class="relative">
            <div x-show="open" class="w-64 bg-green-700 text-white h-screen transition-transform duration-300">
                <div class="py-4 px-6">
                    <h2 class="text-lg font-bold">Dashboard</h2>
                    <ul class="mt-4">
                        <li class="my-2">
                            <a href="{{ route('users.index') }}" class="block p-2 hover:bg-gray-700">Manage Users</a>
                        </li>
                        <li class="my-2">
                            <a href="{{ route('products.index') }}" class="block p-2 hover:bg-gray-700">Manage Products</a>
                        </li>
                        <li class="my-2">
                            <a href="{{ route('roles.index') }}" class="block p-2 hover:bg-gray-700">Manage Roles</a>
                        </li>
                        <li class="my-2">
                            <a href="{{ route('orders.index') }}" class="block p-2 hover:bg-gray-700">Manage Orders</a>
                        </li>
                        <li class="my-2">
                            <a href="{{ route('categories.index') }}" class="block p-2 hover:bg-gray-700">Manage Categories</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button icon="bars-4" @click="open = !open" class="absolute left-0 top-0 p-2 bg-orange-500 text-white">
                <span class="sr-only">Toggle Sidebar</span>
                
            </button>
        </div>

        <div class="flex-1">
            <!-- Top Navbar -->
            <div class="bg-orange-500 shadow flex items-center justify-between px-4 py-2">
                <div class="flex-1 mx-4">
                    <input type="text" placeholder="Search..." class="w-2xl p-2 border border-gray-300 rounded">
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="text-gray-600 focus:outline-none">
                            <span class="material-icons">notifications</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden" id="notificationDropdown">
                            <div class="p-2">No new notifications.</div>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="font-semibold">Hello, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <main class="max-w-7xl mx-auto py-8 px-4">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    @wireuiScripts
    
</body>
</html>