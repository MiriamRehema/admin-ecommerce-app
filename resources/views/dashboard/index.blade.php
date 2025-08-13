@extends('layouts.dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">User Summary</h2>
            <p class="text-3xl font-semibold">{{ $userCount }}</p>
            <p class="text-gray-500">Total Users</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">Order Summary</h2>
            <p class="text-3xl font-semibold">{{ $orderCount }}</p>
            <p class="text-gray-500">Total Orders</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">Product Summary</h2>
            <p class="text-3xl font-semibold">{{ $productCount }}</p>
            <p class="text-gray-500">Total Products</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">Category Summary</h2>
            <p class="text-3xl font-semibold">{{ $categoryCount }}</p>
            <p class="text-gray-500">Total Categories</p>
        </div>
    </div>
        <!-- You can add cards for Products, Roles, etc. -->
    </div>
@endsection
