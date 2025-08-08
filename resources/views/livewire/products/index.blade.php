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
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Active</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is Featured</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is New</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Is On Sale</th>

                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($products as $product)
                            <tr>
                                
                                <td class="px-4 py-2">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="w-16 h-16 object-cover" />
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->slug }}</td>
                                <td class="px-4 py-2">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $product->stock }}</td>
                                <td class="px-4 py-2">{{ $product->price }}</td>
                                <td class="px-4 py-2">@if($product->is_active)
                                     <x-badge flat green label="Active" />
                                    @else
                                        <x-badge flat red label="Inactive" />
                                    @endif
                                </td>
                                <td class="px-4 py-2">@if($product->is_featured )
                                     <x-badge flat green label="Active" />
                                    @else
                                        <x-badge flat red label="Inactive" />
                                    @endif
                                </td>
                                <td class="px-4 py-2">@if($product->is_new)
                                     <x-badge flat green label="Active" />
                                    @else
                                        <x-badge flat red label="Inactive" />
                                    @endif
                                </td>
                                <td class="px-4 py-2">@if($product->is_on_sale)
                                     <x-badge flat green label="Active" />
                                    @else
                                        <x-badge flat red label="Inactive" />
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">

   
                                    @can('product-edit')
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <x-button icon="pencil-square" flat interaction:solid="info" style="color: green;" />
                                        </a>
                                    @endcan
                                    @can('product-list')
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <x-button icon="eye" flat interaction:solid="positive" style="color: info;" />
                                        </a>
                                    @endcan
                                    @can('product-delete')
                                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')

                                            <x-mini-button rounded icon="trash" flat gray interaction="negative" style="color: red;" type="submit" />
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
                    <x-input icon="shopping-bag" label="Product Name" name="name" placeholder="Product" />
                    @error('name')
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
                    <x-input type="file" label="Image" name="image" />
                    @error('image')
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
    <label for="is_active">Is Active:</label>
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
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
    <label for="is_featured">Is Featured:</label>
    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', 1) ? 'checked' : '' }}>
</div>
                <div>
    <label for="is_new">Is New:</label>
    <input type="checkbox" name="is_new" value="1" {{ old('is_new', 1) ? 'checked' : '' }}>
</div>
                <div>
    <label for="is_on_sale">Is On Sale:</label>
    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', 1) ? 'checked' : '' }}>
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