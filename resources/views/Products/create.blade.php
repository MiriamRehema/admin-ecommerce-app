@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-modal-card title="Create Product" name="createProductModal">
        <x-slot name="slot">
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
        </x-slot>

        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>
</div>
@endsection