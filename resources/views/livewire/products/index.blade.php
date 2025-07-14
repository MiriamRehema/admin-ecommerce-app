<div class="max-w-full mx-auto py-8">
    <x-card title="PRODUCTS">
        <x-slot name="slot">
            @if (session('success'))
                <x-alert title="Success Message!" positive />
            @endif

            <!-- Button to open the modal -->
            <x-button label="Add Product" x-on:click="$openModal('createProductModal')" warning />

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
                        @foreach($products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <x-button icon="pencil" small primary label="Edit" />
                                    </a>
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <x-button icon="eye" small info label="Show" />
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?');">
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

    <!-- Modal for creating a product -->
    <x-modal-card title="Create Product" name="createProductModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input icon="shopping-bag" label="Name" name="nam" placeholder="Product" />
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
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