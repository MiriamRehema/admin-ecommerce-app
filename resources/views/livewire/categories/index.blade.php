<div class="max-w-full mx-auto py-8">
    <x-card title="CATEGORIES">
        <x-slot name="slot">
            @if (session('success'))
                <x-alert title="Success Message!" positive />
            @endif

            <!-- Button to open the modal -->
            
                <x-button label="Add Category" x-on:click="$openModal('createCategoryModal')" warning />
            

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Active</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->slug }}</td>
                                <td class="px-4 py-2">{{ $category->is_active ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $category->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    @can('category-edit')
                                        <a href="{{ route('categories.edit', $category->id) }}">
                                            <x-button icon="pencil" small primary label="Edit" />
                                        </a>
                                    @endcan
                                    @can('category-list')
                                        <a href="{{ route('categories.show', $category->id) }}">
                                            <x-button icon="eye" small info label="Show" />
                                        </a>
                                    @endcan
                                    @can('category-delete')
                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-button icon="trash" small negative label="Delete" type="submit" />
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>

    <!-- Modal for creating a category -->
    <x-modal-card title="Create Category" name="createCategoryModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('categories.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <div>
                    <x-input icon="tag" label=" Name" name="name" placeholder=" Category name" required />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input label="Slug" name="slug" placeholder="Enter category slug" required />
                    @error('slug')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input type="file" label="Image" name="image" />
                    @error('image')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input label="Description" name="description" placeholder="Enter description" />
                    @error('description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-toggle id="color-positive" name="toggle" label="Is Active" warning xl />
                </div>

                <div class="mt-4">
                    <x-button type="submit" positive label="Create" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="flex justify-end">
            <x-button flat label="Cancel" x-on:click="close" />
        </x-slot>
    </x-modal-card>
</div>