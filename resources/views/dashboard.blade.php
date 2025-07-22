<x-layouts.app :title="__('Dashboard')">
    <div class="max-w-7xl mx-auto py-8 px-4">
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
</x-layouts.app>