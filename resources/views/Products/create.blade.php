@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Create Product</h1>
    <a href="{{ route('products.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
        @csrf

        <div>
            <x-input icon="shopping-bag" label="Name" name="name" placeholder="Product" />
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-button type="submit" positive label="Create" />
        </div>
    </form>
</div>
@endsection