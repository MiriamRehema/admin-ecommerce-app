@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <x-card title="Show Product">
        <x-slot name="slot">
            <a href="{{ route('products.index') }}">
                <x-button icon="arrow-left" class="mb-4" label="Back" />
            </a>
            <div class="space-y-4">
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <!-- Uncomment the line below if you want to show the price -->
                <!-- <p><strong>Price:</strong> {{ $product->price }}</p> -->
            </div>
        </x-slot>
    </x-card>
</div>
@endsection