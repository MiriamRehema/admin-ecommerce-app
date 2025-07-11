<div class="max-w-5xl mx-auto py-8">
    <x-card title="Users">
        <x-slot name="slot">
            @if (session('success'))
                 <x-alert title="Success Message!" positive />
            @endif

            <a href="{{ route('users.create') }}">
                <x-button icon='plus' label="Add User" x-on:click="$openModal('cardModal')" warning />

                <!-- <x-button class="mb-4" icon="plus" positive label="Add User" /> -->
            </a>

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
</div>