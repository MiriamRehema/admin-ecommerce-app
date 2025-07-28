@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-10">

    <h1 class="text-2xl font-semibold">Order Details</h1>

    <a href="{{ route('orders.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>

    <div class="space-y-6">
        <div>
            <x-input 
                icon="user" 
                label="User ID" 
                name="user_id" 
                value="{{ $order->user_id }}" 
                readonly 
            />
        </div>

        <div>
            <x-select
                label="Payment Method"
                name="payment_method"
                :options="['credit_card' => 'Credit Card', 'paypal' => 'PayPal', 'bank_transfer' => 'Bank Transfer']"
                placeholder="Select Payment Method"
                :selected="$order->payment_method"
                disabled
            />
        </div>

        <div>
            <x-select
                label="Payment Status"
                name="payment_status"
                :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled']"
                placeholder="Select Payment Status"
                :selected="$order->payment_status"
                disabled
            />
        </div>

        <div>
            <x-select
                label="Order Status"
                name="status"
                :options="['new' => 'New', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']"
                placeholder="Select Order Status"
                :selected="$order->status"
                disabled
            />
        </div>

        <div>
            <x-input 
                icon="currency-dollar" 
                label="Shipping Amount" 
                name="shipping_amount" 
                value="{{ $order->shipping_amount }}" 
                readonly 
            />
        </div>

        <div>
            <x-textarea 
                label="Notes" 
                name="notes" 
                readonly
            >{{ $order->notes }}</x-textarea>
        </div>

        <div>
            <h3 class="text-lg font-medium">Order Items</h3>
            <ul class="space-y-2">
                @foreach($order->items as $item)
                    <li class="flex justify-between">
                        <span>{{ $item->name }} (Quantity: {{ $item->quantity }}, Price: ${{ $item->price }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection 

