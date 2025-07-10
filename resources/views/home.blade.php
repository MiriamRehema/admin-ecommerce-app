@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <x-card>
        <x-slot name="title">
            {{ __('Dashboard') }}
        </x-slot>
        @if (session('status'))
            <x-notification icon="success" class="mb-4">
                {{ session('status') }}
            </x-notification>
        @endif

        <div class="text-gray-700 text-lg">
            {{ __('You are logged in!') }}
        </div>
    </x-card>
</div>
@endsection