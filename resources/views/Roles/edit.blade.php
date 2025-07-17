@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Update Role">
        <x-slot name="slot">
            <a href="{{ route('roles.index') }}">
              <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            
            <form method="POST" action="{{ route('roles.update',  $role->id) }}" class="space-y-6">
             @csrf
             @method("PUT")
             

            <div >
            <label>Name:</label>
            <x-input icon="users" name="name" placeholder="Role" value="{{$role->name}}"/>
            @error("name")
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
       
            <div>

                <h3 class="text-2xl font-semibold">Permissions:</h3>
                @foreach($permissions as $permission)
                <div class="checkbox checkbox-success">

                    <input

                    type="checkbox" 
                    name="permissions[]" 
                    
                    value="{{ $permission->name }}"  
                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} 
                     />
                <label for="{{ $permission->name }}">
                {{ $permission->name }}
                </label>
        </div>
    @endforeach
</div>
        

        

             <div>
            <x-button type="submit" positive label="Update" />
             </div>
            </form>

        </x-slot>

    </x-card>
        

    
    
</div>
@endsection