@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">

    <h1 class="text-2xl font-semibold">Order Item Details</h1>

    <a href="{{ route('order-items.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <div class="space-y-6">
        <div>
            <x-input 
                label="Order ID" 
                name="order_id" 
                value="{{ $orderItem->order_id }}" 
                readonly 
            />
        </div>

        <div>
            <x-input 
                label="Product ID" 
                name="product_id" 
                value="{{ $orderItem->product_id }}" 
                readonly 
            />
        </div>

        <div>
            <x-input 
                label="Quantity" 
                name="quantity" 
                value="{{ $orderItem->quantity }}" 
                readonly 
            />
        </div>

        <div>
            <x-input 
                label="Unit Amount" 
                name="unit_amount" 
                value="{{ $orderItem->unit_amount }}" 
                readonly 
            />
        </div>

        <div>
            <x-input 
                label="Total Amount" 
                name="total_amount" 
                value="{{ $orderItem->total_amount }}" 
                readonly 
            />
        </div>
    </div>
</div>

@endsection