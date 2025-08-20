<div class="p-6">
    @if ($mode === 'index')
        @can('order-create')
            <x-button positive label="Add Order" wire:click="create" class="mb-4" />
        @endcan

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Grand Total</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Shipping</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->grand_total }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->shipping_amount }}</td>
                        <td class="space-x-2">
                            @can('order-list')
                                <x-button xs info wire:click="show({{ $order->id }})" label="View" />
                            @endcan
                            @can('order-edit')
                                <x-button xs warning wire:click="edit({{ $order->id }})" label="Edit" />
                            @endcan
                            @can('order-delete')
                                <x-button xs negative wire:click="confirmDelete({{ $order->id }})" label="Delete" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($confirmingDelete)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
                    <p class="mb-4">Are you sure you want to delete this order?</p>
                    <div class="flex justify-end space-x-4">
                        <x-button flat label="Cancel" wire:click="$set('confirmingDelete', false)" />
                        <x-button negative label="Delete" wire:click="deleteConfirmed" />
                    </div>
                </div>
            </div>
        @endif

    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">
            <x-select 
                wire:model="user_id" 
                label="User"
                :options="$users" 
                option-label="name" 
                option-value="id"
            />
            <x-select 
                wire:model="payment_method" 
                label="Payment Method"
                :options="['credit_card' => 'Credit Card', 'paypal' => 'PayPal', 'bank_transfer' => 'Bank Transfer']"
            />
            <x-select 
                wire:model="payment_status" 
                label="Payment Status"
                :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled']"
            />
            <x-select 
                wire:model="status" 
                label="Order Status"
                :options="['new' => 'New', 'procesing' => 'Procesing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']"
            />
            <x-input wire:model="shipping_amount" type="number" label="Shipping Amount" />
            <x-textarea wire:model="notes" label="Order Notes" />

            <hr />
            <h3 class="text-lg font-bold mt-4">Order Items</h3>

            @foreach ($orderItems as $index => $item)
                <div class="grid grid-cols-4 gap-4 items-end">
                    <x-select 
                        wire:model="orderItems.{{ $index }}.product_id" 
                        label="Product"
                        :options="$products" 
                        option-label="name" 
                        option-value="id"
                    />
                    <x-input 
                        wire:model="orderItems.{{ $index }}.quantity" 
                        type="number" 
                        label="Quantity" 
                    />
                    <x-input 
                        wire:model="orderItems.{{ $index }}.unit_amount" 
                        type="number" 
                        label="Unit Amount" 
                    />
                    <x-input 
                        wire:model="orderItems.{{ $index }}.total_amount" 
                        type="number" 
                        label="Total Amount" 
                    />
                    @if (count($orderItems) > 1)
                    <x-button 
                    label="Remove" 
                    wire:click.prevent="removeItem({{ $index }})" 
                     negative 
                      class="mt-4"
                    />
                    @endif
                </div>
            @endforeach

            <x-button label="Add Item" wire:click.prevent="addItem" class="mt-2" />

            <div class="flex gap-2 mt-4">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create Order' : 'Update Order' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    @elseif ($mode === 'show' && $selectedOrder)
        <x-card title="Order Details">
            <p><strong>User:</strong> {{ $selectedOrder->user->name ?? 'N/A' }}</p>
            <p><strong>Total:</strong> {{ $selectedOrder->grand_total }}</p>
            <p><strong>Shipping:</strong> {{ $selectedOrder->shipping_amount }}</p>
            <p><strong>Status:</strong> {{ $selectedOrder->status }}</p>
            <p><strong>Payment:</strong> {{ $selectedOrder->payment_status }}</p>
            <p><strong>Notes:</strong> {{ $selectedOrder->notes }}</p>

            <hr class="my-4" />

            <h3 class="text-lg font-bold">Items</h3>
            <ul class="list-disc list-inside">
                @foreach ($selectedOrder->items as $item)
                    <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->unit_amount }} = {{ $item->total_amount }}</li>
                @endforeach
            </ul>

            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif
</div>
