<div class="p-6">

    @if ($mode === 'index')
        <x-button positive label="Add User" wire:click="create" class="mb-4" />
        
        <x-select 
    label="Search User"
    placeholder="Select User"
    :async-data="route('user-search')" 
    option-label="name" 
    option-value="id" 
    wire:model="user_id" />
        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="space-x-2">
                            <x-button xs info wire:click="show({{ $user->id }})" label="View" />
                            <x-button xs warning wire:click="edit({{ $user->id }})" label="Edit" />
                            <x-button xs negative wire:click="delete({{ $user->id }})" label="Delete" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">
            <x-input wire:model="name" label="Name" />
            <x-input wire:model="email" label="Email" />
            <x-password wire:model="password" label="Password" />

            <x-select
                label="Roles"
                wire:model="roles"
                multiselect
                :options="$roles->pluck('name', 'id')->toArray()" />

            <label>
                <input type="checkbox" wire:model="is_active" /> Active
            </label>

            <div class="flex gap-2">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create' : 'Update' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    @elseif ($mode === 'show')
        <x-card title="User Details">
            <p><strong>Name:</strong> {{ $selectedUser->name }}</p>
            <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
            <p><strong>Roles:</strong> {{ $selectedUser->roles->pluck('name')->join(', ') }}</p>
            <p><strong>Status:</strong> {{ $selectedUser->is_active ? 'Active' : 'Inactive' }}</p>

            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif
</div>
