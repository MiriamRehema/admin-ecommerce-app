@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800">{{ __('Verify Your Email Address') }}</h2>

        <div class="mt-4">
            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('If you did not receive the email') }},
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="text-blue-600 underline">{{ __('click here to request another') }}</button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection