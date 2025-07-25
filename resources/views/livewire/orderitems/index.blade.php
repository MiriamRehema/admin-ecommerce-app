<div>
   <x-card title"Order Items">
        <x-slot name="slot">
            <div class="flex justify-end mb-4">
                <x-button positive label="Create Order Item" wire:click="$emit('openModal', 'orderitems.create')" />
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orderitems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->order_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->product_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->unit_amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->total_amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <x-button icon="pencil" flat interaction:solid="info" wire:click="$emit('openModal', 'orderitems.edit', {{ $item->id }})" />
                                    <form method="POST" action="{{ route('order-items.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button icon="trash" flat interaction:solid="negative" type="submit" />
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-card>
</div>
