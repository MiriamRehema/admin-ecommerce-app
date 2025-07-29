<div class="max-w-full mx-auto py-8">
    <x-card title="PRODUCTS">
        <x-slot name="slot">
            @if (session('success'))
                <x-alert title="Success Message!" positive />
            @endif

            <!-- Button to open the modal -->
            @can('product-create')

            <x-button label="Add Product" x-on:click="$openModal('createProductModal')" warning />
            @endcan
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Active</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Featured</th>

                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->slug }}</td>
                                <td class="px-4 py-2">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $product->stock }}</td>
                                <td class="px-4 py-2">{{ $product->price }}</td>
                                <td class="px-4 py-2">{{ $product->is_active ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $product->is_new ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $product->is_on_sale ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
   
                                    @can('product-edit')
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <x-button icon="pencil" small primary label="Edit" />
                                        </a>
                                    @endcan
                                    @can('product-list')
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <x-button icon="eye" small info label="Show" />
                                        </a>
                                    @endcan
                                    @can('product-delete')
                                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?');">
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

    <!-- Modal for creating a product -->
    <x-modal-card title="Create Product" name="createProductModal">
        <x-slot name="slot">
            <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input icon="shopping-bag" label="Product Name" name="product_name" placeholder="Product" />
                    @error('product_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-input icon="tag" label="Slug" name="slug" placeholder="product-slug" />
                       @error('slug')
                           <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                       @enderror
                </div>
                <div>
                     <x-input label="Description" name="description" placeholder="Product description" />
                       @error('description')
                     <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                </div>
                <div>
                     <x-input label="Price" name="price" type="number" step="0.01" placeholder="Product price" />
                       @error('price')
                     <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                      @enderror
                </div>
                <div>
                     <x-input label="Stock" name="stock" type="number" placeholder="Available stock" />
                      @error('stock')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                     @enderror
                </div>
                <div>
                      <x-toggle id="is_active" name="is_active" label="Is Active" />
                    @error('is_active')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                     @enderror

                </div>
                <div>
                <x-select
                label="Category"
                name="category_id"
                placeholder="Select a category"
                :options="$categories->pluck('name', 'id')->toArray()"
                />
                 @error('category_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
                </div>
                <div>
                  <x-toggle id="is_featured" name="is_featured" label="Is Featured" />
                    @error('is_featured')
                   <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <x-toggle id="is_new" name="is_new" label="Is New" />
                      @error('is_new')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                       @enderror
                </div>
                <div>
                   <x-toggle id="is_on_sale" name="is_on_sale" label="Is On Sale" />
                         @error('is_on_sale')
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