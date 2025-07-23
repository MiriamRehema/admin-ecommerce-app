@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-2xl font-semibold">Create Order</h1>
    <a href="{{ route('orders.index') }}">
        <x-button icon="arrow-left" class="mb-4" label="Back" />
    </a>
    <form method="POST" action="{{ route('orders.store') }}">  
        @csrf

        <div class="space-y-6">
            <div>
                <x-input icon="user" label="User ID" name="user_id" placeholder="User ID" />
                @error('user_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            

            
            <div>
                <x-select
                    label=" Payment Method"
                    name="payment_method"
                    :options="['credit_card' => 'Credit Card', 'paypal' => 'PayPal', 'bank_transfer' => 'Bank Transfer']"
                    placeholder="Select Payment Method"
                />
                @error('payment_method')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <x-select
                    label=" Payment Status"
                    name="payment_status"
                    :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled']"
                    placeholder="Select Payment Status"
                />

            @error('payment_status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror

            <div>
                <x-select
                    label=" Order Status"
                    name="status"
                    :options="['new' => 'New', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']"
                    placeholder="Select Order Status"
                />
            </div>
            @error('order_status')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div>
                <x-input icon="currency-dollar" label="Shipping Amount" name="shipping_amount" placeholder="Shipping Amount" />
                @error('shipping_amount')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            

            <div>
                <x-textarea label="Notes" name="notes" placeholder="Additional notes about the order" />
                @error('notes')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

            <div>
                <x-button type="submit" positive label="Create Order" />
            </div>
        </div> 
    </form>

</div>

@endsection
