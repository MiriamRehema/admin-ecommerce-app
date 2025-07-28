<div class="max-full mx-auto py-8">
    <x-card title="ORDERS">
        <x-slot name="slot">
            @if (session('success'))
                <x-alert title="Success Message!" positive />
            @endif

            <x-button label="Add Order" x-on:click="$openModal('createOrderModal')" warning />
            
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">User ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Grand Total</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Payment Method</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Order Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Shipping Amount</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->user_id }}</td>
                                <td class="px-4 py-2">{{ $order->grand_total }}</td>
                                <td class="px-4 py-2">{{ $order->payment_method }}</td>
                                <td class="px-4 py-2">{{ $order->payment_status }}</td>
                                <td class="px-4 py-2">{{ $order->status }}</td>
                                <td class="px-4 py-2">{{ $order->shipping_amount }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    @can('order-edit')
                                        <a href="{{ route('orders.edit', $order->id) }}">
                                            <x-button icon="pencil" small primary label="Edit" />
                                        </a>
                                    @endcan
                                    @can('order-list')
                                        <a href="{{ route('orders.show', $order->id) }}">
                                            <x-button icon="eye" small info label="Show" />
                                        </a>
                                    @endcan
                                    @can('order-delete')
                                        <form method="POST" action="{{ route('orders.destroy', $order->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-button icon="trash" small negative label="Delete" type="submit" />
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>

    <!-- Modal for creating an order -->
    <x-modal-card title="Create Order" name="createOrderModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                @csrf
                <div>
                    <x-select 
                        label="User"
                        name="user_id"
                        :options="$users"
                        option-label="name"
                        option-value="id"
                        placeholder="Select User"
                        id="user_id"
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
                        id="payment_method" 
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
                        id="payment_status" 
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
                        id="order_status"
                    />
                    @error('status')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-input icon="currency-dollar" label="Shipping Amount" name="shipping_amount" id="shipping_amount" placeholder="Shipping Amount" />
                    @error('shipping_amount')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-textarea label="Notes" name="notes" id="notes" placeholder="Additional notes about the order" />
                    @error('notes')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-button type="submit" positive label="Create Order" />
                </div>
            </form>
        </x-slot>
        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>

    <x-modal-card title="Create Order Item" name="createOrderItemModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('order-items.store') }}" class="space-y-6">
                @csrf
                <div>
                    <x-select
                        label="Order"
                        name="order_id"
                        :options="$orders"
                        option-label="id"
                        option-value="id"
                        placeholder="Select Order"
                        id="order_id" 
                    />
                    @error('order_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-select
                        label="Product"
                        name="product_id"
                        :options="$products"
                        option-label="name"
                        option-value="id"
                        placeholder="Select Product"
                        id="product_id" 
                    />
                    @error('product_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-input label="Quantity" name="quantity" type="number" placeholder="Quantity" id="quantity" />
                    @error('quantity')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-input label="Unit Amount" name="unit_amount" type="number" step="1" placeholder="Unit Amount" id="unit_amount" />
                    @error('unit_amount')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-input label="Total Amount" name="total_amount" type="number" step="1" placeholder="Total Amount" id="total_amount" />
                    @error('total_amount')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-button type="submit" positive label="Create Order Item" />
                </div>
            </form>
        </x-slot>
        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>

</div>