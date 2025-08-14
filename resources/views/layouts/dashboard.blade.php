<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    

   
      <!-- ✅ WireUI CDN -->
     <script src="//unpkg.com/alpinejs" defer></script>
    
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Dashboard
        </div>
        <nav class="p-4 space-y-2">
            @can('user-list')
                <a href="#" onclick="loadContent(event, '{{ route('dashboard.users') }}')" class="block p-2 hover:bg-gray-700 rounded">Manage Users</a>
            @endcan
            @can('product-list')
                <a href="#" onclick="loadContent(event, '{{ route('dashboard.products') }}')" class="block p-2 hover:bg-gray-700 rounded">Manage Products</a>
            @endcan
            @can('role-list')
                <a href="#" onclick="loadContent(event, '{{ route('dashboard.roles') }}')" class="block p-2 hover:bg-gray-700 rounded">Manage Roles</a>
            @endcan
            @can('order-list')
                <a href="#" onclick="loadContent(event, '{{ route('dashboard.orders') }}')" class="block p-2 hover:bg-gray-700 rounded">My Orders</a>
            @endcan
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">

        <!-- Top navbar -->
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex items-center justify-between">
            <div class="text-xl font-semibold text-gray-900 dark:text-white">Admin Panel</div>

            <div class="flex items-center space-x-4">
                <!-- Notification Icon -->
                <button class="relative">
                    <span class="material-icons text-gray-700 dark:text-white">notifications</span>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="avatar" class="w-8 h-8 rounded-full">
                        <span class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded shadow-lg z-50">
                        <a href="{{ route('settings.profile') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>

                        <button onclick="toggleDarkMode()" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                            Switch Mode
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-6" id="dashboard-content">
            @yield('content')
        </main>
    </div>
</div>

<!-- JS to dynamically load partials into content area -->
<script>
    function loadContent(event, url) {
        event.preventDefault();
        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById('dashboard-content').innerHTML = html;
            })
            .catch(err => console.error("Error loading content", err));
    }

    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle('dark');
        localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    }

    // Load theme from localStorage
    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });
</script>

@livewireScripts

</body>
</html>