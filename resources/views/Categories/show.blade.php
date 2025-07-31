@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Category Details">
        <x-slot name="slot">
            <a href="{{ route('categories.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <div class="space-y-4">
                <p><strong>Name:</strong> {{ $category->name }}</p>
                <p><strong>Slug:</strong> {{ $category->slug }}</p>
                <p><strong>Description:</strong> {{ $category->description }}</p>
                <p><strong>Is Active:</strong> {{ $category->is_active ? 'Yes' : 'No' }}</p>
                <p><strong>Created At:</strong> {{ $category->created_at->format('Y-m-d H:i') }}</p>
                <div>
                    <strong>Image:</strong>
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="Category Image" class="w-32 h-32 object-cover" />
                    @else
                        No Image
                    @endif
                </div>
            </div>
        </x-slot>
    </x-card>
</div>
@endsection