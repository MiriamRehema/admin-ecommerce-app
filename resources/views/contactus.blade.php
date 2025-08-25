@extends('layouts.app')

@section('content')
<section class="bg-white dark:bg-gray-900 py-16 font-poppin">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <!-- Section Header -->
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Contact <span class="text-green-600">Us</span></h2>
      <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
        Have questions or need help? We're just a message away.
      </p>
    </div>

    <!-- Grid: Contact Info & Form -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Contact Info -->
      <div class="space-y-6 text-gray-700 dark:text-gray-200">
        <div class="flex items-start gap-4">
          <div class="text-3xl text-orange-500">📧</div>
          <div>
            <h4 class="font-semibold text-lg">Email Us</h4>
            <p>info@yourecommerce.com</p>
          </div>
        </div>
        <div class="flex items-start gap-4">
          <div class="text-3xl text-green-600">📞</div>
          <div>
            <h4 class="font-semibold text-lg">Call Us</h4>
            <p>+254 712 345 678</p>
          </div>
        </div>
        <div class="flex items-start gap-4">
          <div class="text-3xl text-orange-500">📍</div>
          <div>
            <h4 class="font-semibold text-lg">Visit Us</h4>
            <p>Nairobi, Kenya</p>
          </div>
        </div>

        <!-- Google Map -->
        <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.111891327196!2d36.8219464!3d-1.2920656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d4cbbdfb5f%3A0x1730d7d4181fc2b0!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2ske!4v1631808674203!5m2!1sen!2ske"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <!-- <form action="{{ route('contact.send') }}" method="POST" class="space-y-6"> -->
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Name</label>
            <input type="text" name="name" required
              class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:text-white">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
            <input type="email" name="email" required
              class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:text-white">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
            <input type="text" name="subject" required
              class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:text-white">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
            <textarea name="message" rows="5" required
              class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:text-white"></textarea>
          </div>
          <div>
            <button type="submit"
              class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-md transition">
              Send Message
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
