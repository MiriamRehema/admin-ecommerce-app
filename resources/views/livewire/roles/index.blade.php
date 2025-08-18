<div class="p-6">
    @if ($mode === 'index')
        @can('role-create')
            <x-button positive label="Add Role" wire:click="create" class="mb-4" />
        @endcan

        @if (session('success'))
            <x-alert title="{{ session('success') }}" positive class="mb-4" />
        @endif

        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                       
                        <td>{{ $role->created_at->format('Y-m-d H:i') }}</td>
                        <td class="space-x-2">
                            @can('role-list')
                                <x-button xs info wire:click="show({{ $role->id }})" label="View" />
                            @endcan
                            @can('role-edit')
                                <x-button xs warning wire:click="edit({{ $role->id }})" label="Edit" />
                            @endcan
                            @can('role-delete')
                                <x-button xs negative wire:click="confirmDelete({{ $role->id }})" label="Delete" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>

    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">
            <x-input wire:model.defer="name" label="Role Name" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            <div>
                <h3 class="text-lg font-semibold mb-2">Permissions:</h3>
                @foreach($allPermissions as $permission)
                    <label class="flex items-center space-x-2 mb-1">
                        <x-checkbox wire:model="selectedPermissions" value="{{ $permission->name }}" />
                        <span>{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>

            <div class="flex gap-2">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create' : 'Update' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    @elseif ($mode === 'show')
        <x-card title="Role Details">
            <p><strong>Name:</strong> {{ $selectedRole->name }}</p>
            <p><strong>Permissions:</strong> {{ $selectedRole->permissions->pluck('name')->join(', ') }}</p>
            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif

    {{-- Confirmation Modal --}}
    @if ($confirmingDelete)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 dark:bg-opacity-70 z-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-gray-900 dark:text-white">
                <h2 class="text-lg font-bold mb-4">Are you sure?</h2>
                <p class="mb-4">Do you really want to delete this role? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4">
                    <x-button flat label="Cancel" wire:click="$set('confirmingDelete', false)" />
                    <x-button negative label="Delete" wire:click="deleteConfirmed" />
                </div>
            </div>
        </div>
    @endif
</div>
