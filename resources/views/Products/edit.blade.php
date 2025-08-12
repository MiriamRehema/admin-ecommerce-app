@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Update Product">
        <x-slot name="slot">
            <a href="{{ route('products.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <form method="POST" action="{{ route('products.update', $product->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input label="Name" name="name" value="{{ old('name', $product->name) }}" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>

                    <x-input icon="tag" label="Slug" name="slug" placeholder="product-slug" />
                       @error('slug')
                           <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                       @enderror
                </div>
                <div>
                    
                    @if($product->image)
                        <div class="mt-2">
                            <strong>Current Image:</strong>
                            <img src="{{ Storage::url($product->image) }}" alt="Current Product Image" class="w-32 h-32 object-cover" />
                        </div>
                    @endif
                </div>
                <div>
                     <x-input label="Description" name="description" placeholder="Product description" />
                       @error('description')
                     <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                </div>
                <div>
                     <x-input label="Price" name="price" type="number" step="0.01" placeholder="Product price" />
                       @error('price')
                     <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                      @enderror
                </div>
                <div>
                     <x-input label="Stock" name="stock" type="number" placeholder="Available stock" />
                      @error('stock')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                     @enderror
                </div>
                <div>
                    <label for="is_active">Is Active:</label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                </div>
                <div>
    <x-select name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </x-select>
    @error('category_id')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
                <div>
                    <label for="is_featured">Is Featured:</label>
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>   
                </div>
                <div>
                    <label for="is_new">Is New:</label>
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                </div>
                <div>
                    <label for="is_on_sale">Is On Sale:</label>
                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale) ? 'checked' : '' }}>
                </div>

                <div>
                    <x-button type="submit" positive label="Update" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>
@endsection
