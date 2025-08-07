<div class="max-w-full mx-auto py-8">
    <x-card title="USERS">
        <x-slot name="slot">
            @if (session('success'))
                 <x-alert title="Success Message!" positive />
            @endif

            
            
            <x-button md label="Add User" x-on:click="$openModal('createUserModal')" warning />

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Initials</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Active</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr>
                                <td>
                                <x-avatar sm >
                                     <x-slot name="label" class="!text-orange-300 !font-extrabold italic">
                                        {{ $user->initials() }}
                                    </x-slot>
                                </x-avatar>
                                </td>

                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <x-badge flat green label="{{ $role->name }}" />
                                    @endforeach
                                    @if($user->roles->isEmpty())
                                        <x-badge flat rose label="No Role" />
                                    @endif
                                </td>
                                
                                <td class="px-4 py-2">
                                    @if($user->is_active)
                                        <x-badge flat green label="Active" />
                                    @else
                                        <x-badge flat red label="Inactive" />
                                    @endif
                                </td>

                                
                                <td class="px-4 py-2 flex gap-2">
                                    
                                    <a href="{{ route('users.show', $user->id) }}">
                                        <x-button  icon="eye" flat interaction:solid="positive" style="color: info;"/>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <x-button icon="pencil-square " flat interaction:solid="info" style="color: green;" />
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-mini-button rounded icon="trash" flat gray interaction="negative" style="color: red;" type="submit"/>
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
                    <x-select
    label="Select Roles"
    name="roles[]"
    placeholder="Select many roles"
    multiselect
    :selected="$user->roles->pluck('id')->toArray()"
    :options="$roles->pluck('name', 'id')->toArray()"
/>
                </div>
                
                <div>
    <label for="is_active">Is Active:</label>
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
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

