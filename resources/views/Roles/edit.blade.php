@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Update Role</h1>
    <a href="{{ route('roles.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <form method="POST" action="{{ route('roles.store') }}" class="space-y-6">
        @csrf

        <div >
            <x-input icon="users" label="Role" name="role" placeholder="Role" value="{{$role->name}}"/>
            @error("role")
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
       
        <div>
        <h3 class="text-2xl font-semibold">Permissions:</h3>
        @foreach($permissions as $permission)
        <label>
            {{ $permission->name }}
            <x-checkbox  name="permissions[]" value="{{ $permission->id}}"
           {{ $role->hasPermissionTo($permission->id) ?'checked':''}}
            
        </label>
        @endforeach
        </div>
        

        

        <div>
            <x-button type="submit" positive label="Update" />
        </div>
    </form>
    
</div>
@endsection