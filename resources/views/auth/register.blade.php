@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input id="name" type="text" class="mt-1 block w-full rounded-md shadow-sm @error('name') border-red-400 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="mt-1 block w-full rounded-md shadow-sm @error('email') border-red-500 @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="mt-1 block w-full rounded-md shadow-sm @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded-md py-2 hover:bg-blue-700">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>
@endsection