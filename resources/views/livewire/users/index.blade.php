<div class="max-w-full mx-auto py-8">
    <x-card title="USERS">
        <x-slot name="slot">
            @if (session('success'))
                 <x-alert title="Success Message!" positive />
            @endif

            

            <x-button label="Add User" x-on:click="$openModal('createUserModal')" warning />

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
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <x-button icon="pencil" small primary label="Edit" />
                                    </a>
                                    <a href="{{ route('users.show', $user->id) }}">
                                        <x-button icon="eye" small info label="Show" />
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button icon="trash" small negative label="Delete" type="submit" />
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>

    <!-- Modal for creating users -->
     <x-modal-card title="Create User" name="createUserModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <div>
                     <x-input icon="users" label="Name" name="name" placeholder='Name' />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input icon='envelope'  label="Email" name="email" placeholder='Email' />
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-password label="Password"  name="password" value="I love WireUI ❤️" />
                    
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-button type="submit" positive label="Submit" />
                </div>
            </form>

        </x-slot>

        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>
</div>

