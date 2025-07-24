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
            <x-input icon="tag" label="Slug" name="slug" placeholder="product-slug" />
            @error('slug')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
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
            <x-toggle id="is_active" name="is_active" label="Is Active" />
            @error('is_active')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror

        </div>
        <div>
            <x-select
                label="Category"
                name="category_id"
                placeholder="Select a category"
                :options="$categories->pluck('name', 'id')->toArray()"
            />
            @error('category_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <x-toggle id="is_featured" name="is_featured" label="Is Featured" />
            @error('is_featured')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <x-toggle id="is_new" name="is_new" label="Is New" />
            @error('is_new')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <x-toggle id="is_on_sale" name="is_on_sale" label="Is On Sale" />
            @error('is_on_sale')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        

        <div>
            <x-button type="submit" positive label="Create" />
        </div>
    </form>
</div>
@endsection