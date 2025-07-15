<div class="max-w-full mx-auto py-8">
    <x-card title="ROLES">
            
        <x-slot name="slot">
            @if (session('success'))
            <x-alert title="Success Message!" positive />
            @endif
            
            <x-button label="Add Role" x-on:click="$openModal('createRoleModal')" warning />
            

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($roles as $role)
                            <tr>
                                <td class="px-4 py-2">{{ $role->id }}</td>
                                <td class="px-4 py-2">{{ $role->name }}</td>
                                <td class="px-4 py-2">{{ $role->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('roles.edit', $role->id) }}">
                                        <x-button icon="pencil" small primary label="Edit" />
                                    </a>
                                    <a href="{{ route('roles.show', $role->id) }}">
                                        <x-button icon="eye" small info label="Show" />
                                    </a>
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button
                                         x-on:click="$wireui.confirmNotification({
                                        title: 'Are you Sure?',
                                        description: 'Save the information?',
                                        icon: 'question',
                                        acceptLabel: 'Yes, save it',
                                        method: 'save',
                                        params: 'Saved',
                                        })"
                                        warning>
                                        Delete
                                        </x-button>
                                       
                                        <!-- <x-button icon="trash" small negative label="Delete" type="submit" /> -->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>

    <!-- Modal fro creating a role -->
     <x-modal-card title="Create Role" name="createRoleModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('roles.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input icon="users" label="Name" name="name" placeholder="Role" />
                    @error('role')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                <h3 class="text-2xl font-semibold">Permissions:</h3>
                @foreach($permissions as $permission)      
                <label>
                {{ $permission->name }}<x-checkbox name="permissions[]" value="{{$permission->id}}" />
                </label>
                @endforeach
                </div>

                <div>
                    <x-button type="submit" positive label="Create" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>
</div>