<div class="max-w-4xl mx-auto py-8">
    <x-card title="PRODUCTS">
        <x-slot name="slot">
            @if (session('success'))
                <x-button wire:click="successNotification" positive>
                 Success Notification
                </x-button>
            @endif

            <a href="{{ route('products.create') }}">
                <x-button class="mb-4" icon="plus" positive label="Add Product" />
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
</div>