@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Edit Category">
        <x-slot name="slot">
            <a href="{{ route('categories.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <x-input icon="tag" label="Name" name="name" placeholder="Category name" value="{{ old('name', $category->name) }}" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input label="Slug" name="slug" placeholder="Enter category slug" value="{{ old('slug', $category->slug) }}" />
                    @error('slug')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input type="file" label="Image" name="image" />
                    @error('image')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @if($category->image)
                        <div class="mt-2">
                            <strong>Current Image:</strong>
                            <img src="{{ Storage::url($category->image) }}" alt="Current Category Image" class="w-32 h-32 object-cover" />
                        </div>
                    @endif
                </div>

                <div>
                    <x-input label="Description" name="description" placeholder="Enter description" value="{{ old('description', $category->description) }}" />
                    @error('description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="is_active">Is Active:</label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                </div>

                <div class="mt-4">
                    <x-button type="submit" positive label="Update" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>
@endsection