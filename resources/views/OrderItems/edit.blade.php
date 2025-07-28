@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">

    <h1 class="text-2xl font-semibold">Edit Order Item</h1>

    <a href="{{ route('order-items.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <form method="POST" action="{{ route('order-items.update', $orderItem->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <x-input 
                    label="Order ID" 
                    name="order_id" 
                    placeholder="Order ID" 
                    value="{{ old('order_id', $orderItem->order_id) }}"
                />
                @error('order_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-input 
                    label="Product ID" 
                    name="product_id" 
                    placeholder="Product ID" 
                    value="{{ old('product_id', $orderItem->product_id) }}"
                />
                @error('product_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-input 
                    label="Quantity" 
                    name="quantity" 
                    type="number" 
                    placeholder="Quantity" 
                    value="{{ old('quantity', $orderItem->quantity) }}"
                />
                @error('quantity')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-input 
                    label="Unit Amount" 
                    name="unit_amount" 
                    type="number" 
                    step="1" 
                    placeholder="Unit Amount" 
                    value="{{ old('unit_amount', $orderItem->unit_amount) }}"
                />
                @error('unit_amount')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-button type="submit" positive label="Update Order Item" />
            </div>
        </div>
    </form>
</div>

@endsection