<div class="p-6">
    @if ($mode === 'index')
        <x-button label="Add Category" wire:click="create" class="mb-4" />
        
        @if (session('success'))
            <x-alert title="{{ session('success') }}" positive />
        @endif

        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->slug }}</td>
                        <td>{{ $cat->is_active ? 'Yes' : 'No' }}</td>
                        <td>{{ $cat->created_at->format('Y-m-d') }}</td>
                        <td>
                            <x-button xs label="View" wire:click="show({{ $cat->id }})" />
                            <x-button xs label="Edit" wire:click="edit({{ $cat->id }})" />
                            <x-button xs negative wire:click="confirmDelete({{ $cat->id }})" label="Delete" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($confirmingDelete)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 dark:text-white p-6 rounded shadow">
            <h2 class="text-lg font-bold mb-4">Are you sure?</h2>
            <p class="mb-4">Do you really want to delete this category? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
                <x-button flat label="Cancel" wire:click="$set('confirmingDelete', false)" />
                <x-button negative label="Delete" wire:click="deleteConfirmed" />
            </div>
        </div>
    </div>
@endif

    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">
            <x-input wire:model="name" label="Name" />
            <x-input wire:model="slug" label="Slug" />
            <x-textarea wire:model="description" label="Description" />
            <x-input type="file" wire:model="image" label="Image" />
            <label>
                <input type="checkbox" wire:model="is_active" /> Active
            </label>
            <x-button type="submit" positive label="{{ $mode === 'create' ? 'Create' : 'Update' }}" />
            <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
        </form>

    @elseif ($mode === 'show')
        <x-card title="Category Details">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Slug:</strong> {{ $slug }}</p>
            <p><strong>Description:</strong> {{ $description }}</p>
            <p><strong>Is Active:</strong> {{ $is_active ? 'Yes' : 'No' }}</p>
            @if ($image)
                <img src="{{ Storage::url($image) }}" class="w-32 h-32 object-cover" />
            @endif
            <x-button flat label="Back" wire:click="$set('mode', 'index')" />
        </x-card>
    @endif
</div>
