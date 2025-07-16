@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Show Role">
        <x-slot name="slot">
            <a href="{{ route('roles.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <div class="space-y-4">
                <p><strong>Name:</strong> {{ $role->name }}</p>
                <h4>Permissions:</h4>
               @foreach($role->permissions as $permission)
               <p>{{$permission->name}}</p>
               @endforeach
            </div>
        </x-slot>
    </x-card>
</div>
@endsection