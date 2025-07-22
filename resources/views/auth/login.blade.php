@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="mt-1 block w-full rounded-md shadow-sm {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="mt-1 block w-full rounded-md shadow-sm {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center mb-4">
                <input id="remember" type="checkbox" name="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">{{ __('Remember Me') }}</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded-md py-2 hover:bg-blue-700">
                {{ __('Login') }}
            </button>
            <a href="{{ route('password.request') }}" class="block text-sm text-blue-600 hover:underline mt-4">{{ __('Forgot Your Password?') }}</a>
        </form>
    </div>
</div>
@endsection