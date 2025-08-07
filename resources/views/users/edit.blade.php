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
                    {{-- Display current roles as a list --}}
<ul class="mb-2 text-sm text-gray-600">
    Current Role:
    @forelse($user->roles as $role)
    
        <li>{{ $role->name }}</li>
    @empty
        <li>None</li>
    @endforelse
</ul>
                    <x-select
                    label="Select Roles"
                    name="roles[]"
                    placeholder="Select many roles"
                    :selected="$user->roles->pluck('id')->toArray()"
                    multiselect
                    
                    :options="$roles->pluck('name', 'id')->toArray()" 
                    
                     
                    />
                </div>
                <div>
    <label for="is_active">Is Active:</label>
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
</div>

                <div>
                    <x-button type="submit" positive label="Update" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>

@endsection