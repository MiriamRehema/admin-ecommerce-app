@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <x-card>
        <x-slot name="title">
            {{ __('Dashboard') }}
        </x-slot>
        @if (session('status'))
            <x-alert title="Success Message!" positive />
        @endif

        <div class="text-gray-700 text-lg">
            {{ __('You are logged in!') }}
        </div>
    </x-card>
</div>
@endsection