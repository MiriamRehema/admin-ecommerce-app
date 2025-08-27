@extends('layouts.app')

@section('content')
<!-- Our Solutions Page -->
<section class="py-16 font-poppins dark:bg-gray-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Title -->
    <div class="text-center mb-12">
      <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">
        Our <span class="text-blue-500">Solutions</span>
      </h1>
      <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
        Discover our range of IT and ICT solutions tailored to drive your business forward.
      </p>
    </div>

    <!-- IT Solutions Section -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
        IT Solutions
      </h2>
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @php
          $itSolutions = [
            'Bulk SMS',
            'Shortcodes & USSD',
            'Afrinet Tech Academy',
            
            'Web & Mobile Applications'
          ];
        @endphp
        @foreach ($itSolutions as $solution)
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $solution }}</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">Explore our reliable and efficient {{ $solution }} solutions tailored for your business needs.</p>
        </div>
        @endforeach
      </div>
    </div>

    <!-- ICT Solutions Section -->
    <div>
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
        ICT Hardware Solutions
      </h2>
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Servers</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            The powerhouse of your network, offering processing power and storage. Options include basic file servers to high-performance virtual machines.
          </p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Switches</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            Connect your devices and ensure smooth data flow with a range of basic to advanced switches.
          </p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Routers</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            Manage traffic and internet access for businesses of all sizes with our reliable routers.
          </p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Wi-Fi Access Points</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            Expand your office’s wireless coverage with high-speed and secure Wi-Fi access points.
          </p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Network Storage</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            Centralized, scalable storage for all your business data in one place.
          </p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">UPS Systems</h3>
          <p class="text-gray-600 dark:text-gray-400 mt-2">
            Protect your network with uninterrupted power supply during outages and prevent data loss.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
