@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-10">

    <h1 class="text-2xl font-semibold">Edit Order</h1>

    <a href="{{ route('orders.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <form method="POST" action="{{ route('orders.update', $order->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <x-input 
                    icon="user" 
                    label="User ID" 
                    name="user_id" 
                    placeholder="User ID" 
                    value="{{ old('user_id', $order->user_id) }}" 
                />
                @error('user_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-select
                    label="Payment Method"
                    name="payment_method"
                    :options="['credit_card' => 'Credit Card', 'paypal' => 'PayPal', 'bank_transfer' => 'Bank Transfer']"
                    placeholder="Select Payment Method"
                    :selected="old('payment_method', $order->payment_method)"
                />
                @error('payment_method')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-select
                    label="Payment Status"
                    name="payment_status"
                    :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled']"
                    placeholder="Select Payment Status"
                    :selected="old('payment_status', $order->payment_status)"
                />
                @error('payment_status')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-select
                    label="Order Status"
                    name="status"
                    :options="['new' => 'New', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']"
                    placeholder="Select Order Status"
                    :selected="old('status', $order->status)"
                />
                @error('status')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-input 
                    icon="currency-dollar" 
                    label="Shipping Amount" 
                    name="shipping_amount" 
                    placeholder="Shipping Amount" 
                    value="{{ old('shipping_amount', $order->shipping_amount) }}" 
                />
                @error('shipping_amount')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-textarea 
                    label="Notes" 
                    name="notes" 
                    placeholder="Additional notes about the order" 
                >{{ old('notes', $order->notes) }}</x-textarea>
                @error('notes')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Edit for order items -->
            <div>
                <h2 class="text-lg font-semibold">Order Items</h2>
                @foreach($order->items as $item)
                    <div class="border p-4 mb-4">
                        <x-input 
                            label="Product ID" 
                            name="items[{{ $loop->index }}][product_id]" 
                            placeholder="Product ID" 
                            value="{{ old("items.{$loop->index}.product_id", $item->product_id) }}" 
                        />
                        @error("items.{$loop->index}.product_id")
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <x-input 
                            label="Quantity" 
                            name="items[{{ $loop->index }}][quantity]" 
                            type="number" 
                            placeholder="Quantity" 
                            value="{{ old("items.{$loop->index}.quantity", $item->quantity) }}" 
                        />
                        @error("items.{$loop->index}.quantity")
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <x-input 
                            label="Unit Amount" 
                            name="items[{{ $loop->index }}][unit_amount]" 
                            type="number" 
                            step="0.01" 
                            placeholder="Unit Amount" 
                            value="{{ old("items.{$loop->index}.unit_amount", $item->unit_amount) }}" 
                        />
                        @error("items.{$loop->index}.unit_amount")
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach

            <div>
                <x-button type="submit" positive label="Update Order" />
            </div>
        </div>
    </form>
</div>
 @endsection    