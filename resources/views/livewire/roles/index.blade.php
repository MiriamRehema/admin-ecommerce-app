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
</div>