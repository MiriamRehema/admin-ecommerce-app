<div class="p-6">
    @if ($mode === 'index')
            @can('service-request-create')
            <x-button positive label="Add Service Request" wire:click="create" class="mb-4" />
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceRequests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->name ?? 'N/A' }}</td>
                        <td>{{ $request->grand_total }}</td>
                        <td>{{ $request->payment_method }}</td>
                        <td>{{ $request->payment_status }}</td>
                        <td>{{ $request->status }}</td>
                        <td class="space-x-2">
                            @can('service-request-list')
                                <x-button xs info wire:click="show({{ $request->id }})" label="View" />
                            @endcan
                            @can('service-request-edit')
                                <x-button xs warning wire:click="edit({{ $request->id }})" label="Edit" />
                            @endcan
                            @can('service-request-delete')
                                <x-button xs negative wire:click="confirmDelete({{ $request->id }})" label="Delete" />
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
                    <p class="mb-4">Are you sure you want to delete this service request?</p>
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
                label="Status"
                :options="['new' => 'New', 'in_progress' => 'In Progress', 'completed' => 'Completed', 'cancelled' => 'Cancelled']"
            />

            <x-input wire:model="currency" type="text" label="Currency" />

            <hr />
            <h3 class="text-lg font-bold mt-4">Services</h3>

            @foreach ($orderServices as $index => $service)
                <div class="grid grid-cols-4 gap-4 items-end">
                    <x-select 
                        wire:model="orderServices.{{ $index }}.service_id" 
                        label="Service"
                        :options="$services" 
                        option-label="name" 
                        option-value="id"
                    />
                    <x-input 
                        wire:model="orderServices.{{ $index }}.quantity" 
                        type="number" 
                        label="Quantity" 
                    />
                    <x-input 
                        wire:model="orderServices.{{ $index }}.unit_amount" 
                        type="number" 
                        label="Unit Amount" 
                    />
                    <x-input 
                        wire:model="orderServices.{{ $index }}.total_amount" 
                        type="number" 
                        label="Total Amount" 
                    />

                    @if (count($orderServices) > 1)
                        <x-button 
                            label="Remove" 
                            wire:click.prevent="removeService({{ $index }})" 
                            negative 
                            class="mt-4"
                        />
                    @endif
                </div>
            @endforeach

            <x-button label="Add Service" wire:click.prevent="addService" class="mt-2" />

            <div class="flex gap-2 mt-4">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create Request' : 'Update Request' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    @elseif ($mode === 'show' && $selectedRequest)
        <x-card title="Service Request Details">
            <p><strong>User:</strong> {{ $selectedRequest->user->name ?? 'N/A' }}</p>
            <p><strong>Total:</strong> {{ $selectedRequest->grand_total }}</p>
            <p><strong>Status:</strong> {{ $selectedRequest->status }}</p>
            <p><strong>Payment:</strong> {{ $selectedRequest->payment_status }}</p>
            <p><strong>Payment Method:</strong> {{ $selectedRequest->payment_method }}</p>
            <p><strong>Currency:</strong> {{ $selectedRequest->currency }}</p>

            <hr class="my-4" />

            <h3 class="text-lg font-bold">Services</h3>
            <ul class="list-disc list-inside">
                @foreach ($selectedRequest->order_services as $service)
                    <li>{{ $service->services->name ?? 'N/A' }} - {{ $service->quantity }} × {{ $service->unit_amount }} = {{ $service->total_amount }}</li>
                @endforeach
            </ul>

            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif
</div>

