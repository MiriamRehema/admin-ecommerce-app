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
                    <x-button type="submit" positive label="Update" />
                </div>
            </form>
        </x-slot>
    </x-card>
</div>
@endsection
