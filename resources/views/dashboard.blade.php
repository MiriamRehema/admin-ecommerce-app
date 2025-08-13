@extends('layouts.app')

@section('content')


    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white h-screen">
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

        <div class="flex-1">
            <!-- Top Navbar -->
            <div class="bg-gray-600 shadow flex items-center justify-between px-4 py-2">
                <div>
                    <button class="text-gray-600 focus:outline-none" id="sidebarToggle">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <div class="flex-1 mx-4">
                    <input type="text" placeholder="Search..." class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="text-gray-600 focus:outline-none">
                            <span class="material-icons">notifications</span>
                        </button>
                        <!-- Notification Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden" id="notificationDropdown">
                            <div class="p-2">No new notifications.</div>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="font-semibold">Hello, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 max-w-7xl mx-auto py-8 px-4">
                <div class="grid gap-6 md:grid-cols-3">
                    <x-card class="aspect-video flex items-center justify-center">
                        <a href="{{ route('users.index') }}" class="text-lg font-semibold text-blue-600 hover:underline">
                            Manage Users
                        </a>
                    </x-card>
                    <x-card class="aspect-video flex items-center justify-center">
                        <a href="{{ route('products.index') }}" class="text-lg font-semibold text-green-600 hover:underline">
                            Manage Products
                        </a>
                    </x-card>
                    <x-card class="aspect-video flex items-center justify-center">
                        <a href="{{ route('roles.index') }}" class="text-lg font-semibold text-purple-600 hover:underline">
                            Manage Roles
                        </a>
                    </x-card>
                </div>

                <div class="mt-8">
                    <x-card>
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-2">User Summary</h2>
                            @isset($userCount)
                                <div class="text-3xl font-semibold text-gray-700">{{ $userCount }}</div>
                                <div class="text-gray-500">Total Users</div>
                            @else
                                <div class="text-gray-400">No summary data available.</div>
                            @endisset
                        </div>
                    </x-card>
                </div>
            </div>
        </div>
    </div>


   

@endsection