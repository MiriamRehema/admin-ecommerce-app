
<div class="p-6">

    {{-- Mode: Index --}}
    @if ($mode === 'index')
        @can('service-create')
        <x-button positive label="Add Service" wire:click="create" class="mb-4" />
        @endcan

        <x-input
            type="text"
            name="search"
            wire:model.debounce.500ms="search"
            placeholder="Search by name or description..."
            class="mb-4 w-1/3"
        />

        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->slug }}</td>
                         <td>
                            @if ($service->image)
                                <img src="{{ Storage::url($service->image) }}" class="w-12 h-12 object-cover rounded" />
                            @else
                                N/A
                            @endif
                        </td>
                        <td>${{ number_format($service->price, 2) }}</td>
                        <td>
                            @if ($service->status)
                                <x-badge flat green label="Active" />
                            @else
                                <x-badge flat red label="Inactive" />
                            @endif
                        </td>
                        <td class="space-x-2">
                            @can('service-list')
                            <x-button xs info wire:click="show({{ $service->id }})" label="View" />
                            @endcan
                            @can('service-edit')
                            <x-button xs warning wire:click="edit({{ $service->id }})" label="Edit" />
                            @endcan
                            @can('service-delete')
                            <x-button xs negative wire:click="confirmDelete({{ $service->id }})" label="Delete" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Delete Confirmation Modal --}}
        @if ($confirmingDelete)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white dark:bg-gray-800 dark:text-white p-6 rounded shadow">
                    <h2 class="text-lg font-bold mb-4">Are you sure?</h2>
                    <p class="mb-4">Do you really want to delete this service? This action cannot be undone.</p>
                    <div class="flex justify-end space-x-4">
                        <x-button flat label="Cancel" wire:click="$set('confirmingDelete', false)" />
                        <x-button negative label="Delete" wire:click="deleteConfirmed" />
                    </div>
                </div>
            </div>
        @endif

    {{-- Mode: Create or Edit --}}
    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">

            <x-input wire:model="name" label="Name" />
            <x-input wire:model="slug" label="Slug" />
            <x-textarea wire:model="description" label="Description" />
            <x-input type="number" step="0.01" wire:model="price" label="Price" />
            <x-input type="file" wire:model="image" label="Image" />


   
            
            <label><input type="checkbox" wire:model="status" />Status</label>
            <div class="flex gap-2">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create' : 'Update' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    {{-- Mode: Show --}}
    @elseif ($mode === 'show')
        <x-card title="Service Details">
            <p><strong>Name:</strong> {{ $selectedService->name }}</p>
            <p><strong>Slug:</strong> {{ $selectedService->slug }}</p>
            <p><strong>Description:</strong> {{ $selectedService->description }}</p>
            <p><strong>Price:</strong> ${{ number_format($selectedService->price, 2) }}</p>
            <p><strong>Status:</strong> {{ $selectedService->status?'Active':'Inactive' }}</p>
            <p><strong>Image:</strong> 
                @if ($image)
                    <img src="{{ Storage::url($image) }}" alt="Service Image" class="w-32 mt-2">
                @else
                    No image uploaded.
                @endif
            </p>

            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif

</div>
