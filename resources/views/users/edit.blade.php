@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-8">
    <x-card title="Update User">
        <x-slot name="slot">
            <a href="{{ route('users.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>

            <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input label="Name" name="name" value="{{ old('name', $user->name) }}" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input label="Email" name="email" type="email" value="{{ old('email', $user->email) }}" />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input label="Password" name="password" type="password" />
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-select
                    label="Select Roles"
                    name="roles[]"
                    placeholder="Select many roles"
                    multiselect
                    :options="$roles->pluck('name', 'id')->toArray()" 
                     
                    />
                </div>

                <div>
                    <x-button type="submit" positive label="Update" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>

@endsection