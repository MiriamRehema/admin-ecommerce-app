@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Create Category</h1>
    <a href="{{ route('categories.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
        @csrf

        <div>
            <x-input icon="tag" label="Name" name="name" placeholder="Category Name" required />
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-input label="Slug" name="slug" placeholder="Enter category slug" required />
            @error('slug')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-input type="file" label="Image" name="image" />
            @error('image')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-input label="Description" name="description" placeholder="Enter description" />
            @error('description')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-toggle id="color-positive" name="toggle" label="Is Active" warning xl />
        </div>

        <div class="mt-4">
            <x-button type="submit" positive label="Create" />
        </div>
    </form>

</div>
@endsection
                        