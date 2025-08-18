<div class="p-6">
    @if ($mode === 'index')
        @can('product-create')
            <x-button positive label="Add Product" wire:click="create" class="mb-4" />
        @endcan

        <x-select 
            id="product_id"
            label="Search Product"
            placeholder="Select Product"
            :async-data="route('product-search')" 
            option-label="name" 
            option-value="id" 
            wire:model="product_id" 
        />

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="w-12 h-12 object-cover rounded" />
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if ($product->is_active)
                                <x-badge flat green label="Active" />
                            @else
                                <x-badge flat red label="Inactive" />
                            @endif
                        </td>
                        <td class="space-x-2">
                            <x-button xs info wire:click="show({{ $product->id }})" label="View" />
                            <x-button xs warning wire:click="edit({{ $product->id }})" label="Edit" />
                            <x-button xs negative wire:click="confirmDelete({{ $product->id }})" label="Delete" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($confirmingDelete)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
                    <p class="mb-4">Are you sure you want to delete this product?</p>
                    <div class="flex justify-end space-x-4">
                        <x-button flat label="Cancel" wire:click="$set('confirmingDelete', false)" />
                        <x-button negative label="Delete" wire:click="deleteConfirmed" />
                    </div>
                </div>
            </div>
        @endif

    @elseif ($mode === 'create' || $mode === 'edit')
        <form wire:submit.prevent="{{ $mode === 'create' ? 'store' : 'update' }}" class="space-y-4">
            <x-input wire:model="name" label="Name" />
            <x-input wire:model="slug" label="Slug" />
            <x-textarea wire:model="description" label="Description" />
            <x-input wire:model="price" type="number" label="Price" />
            <x-input wire:model="stock" type="number" label="Stock" />

            <x-select
                wire:model="category_id"
                label="Category"
                :options="$categories->pluck('name', 'id')" />

            <label><input type="checkbox" wire:model="is_active" /> Active</label>
            <label><input type="checkbox" wire:model="is_featured" /> Featured</label>
            <label><input type="checkbox" wire:model="is_new" /> New</label>
            <label><input type="checkbox" wire:model="is_on_sale" /> On Sale</label>

            <div class="flex gap-2">
                <x-button positive type="submit" label="{{ $mode === 'create' ? 'Create' : 'Update' }}" />
                <x-button flat label="Cancel" wire:click="$set('mode', 'index')" />
            </div>
        </form>

    @elseif ($mode === 'show')
        <x-card title="Product Details">
            <p><strong>Name:</strong> {{ $selectedProduct->name }}</p>
            <p><strong>Slug:</strong> {{ $selectedProduct->slug }}</p>
            <p><strong>Category:</strong> {{ $selectedProduct->category->name ?? 'N/A' }}</p>
            <p><strong>Description:</strong> {{ $selectedProduct->description }}</p>
            <p><strong>Price:</strong> {{ $selectedProduct->price }}</p>
            <p><strong>Stock:</strong> {{ $selectedProduct->stock }}</p>
            <p><strong>Status:</strong> {{ $selectedProduct->is_active ? 'Active' : 'Inactive' }}</p>

            <x-button flat label="Back" wire:click="$set('mode', 'index')" class="mt-4" />
        </x-card>
    @endif
</div>
