@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
            <h1 class="text-2xl font-semibold">Create Users</h1>
            <a href="{{ route('users.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <div>
                     <x-input icon="user" label="Name" name="name" placeholder='Name' />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input icon='envelope' name="email"  label="Email" placeholder='Email' />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-password label="Password" name="password"value="I love WireUI ❤️" />
                    
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
    :selected="$user->roles->pluck('id')->toArray()"
    :options="$roles->pluck('name', 'id')->toArray()"
/>
                </div>

                <div>
                    <x-button type="submit" positive label="Submit" />
                </div>
            </form>
        
</div>
@endsection