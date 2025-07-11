@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Create User" name="cardModal">
        <x-slot name="slot">
            <a href="{{ route('users.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <div>
                     <x-input icon="user" label="Name" placeholder='Name' />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input icon='envelope'  label="Email" placeholder='Email' />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-password label="Password" value="I love WireUI ❤️" />
                    
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-button type="submit" positive label="Submit" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>
@endsection