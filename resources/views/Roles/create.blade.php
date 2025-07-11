@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-8">
    <x-card title="Create Role">
        <x-slot name="slot">
            <a href="{{ route('roles.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>

            <form method="POST" action="{{ route('roles.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input label="Name" name="name" value="{{ old('name') }}" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <h3 class="text-lg font-medium">Permissions:</h3>
                    <!-- Add your permissions checkboxes or UI elements here -->
                </div>

                <div>
                    <x-button type="submit" positive label="Create" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>

@endsection