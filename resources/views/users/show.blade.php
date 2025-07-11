@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-8">
    <x-card title="Show User">
        <x-slot name="slot">
            <a href="{{ route('users.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>

            <div class="space-y-4">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <!-- Add more user details here as needed -->
            </div>
        </x-slot>
    </x-card>
</div>

@endsection