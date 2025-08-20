<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $mode = 'index';
    public $product_id;
    public $selectedProduct;
    public $image;
    public $name, $slug, $description, $price, $stock;
    
    public $category_id;
    public $is_active = true;
    public $is_featured = false;
    public $is_new = false;
    public $is_on_sale = false;

    public $categories;
    public $confirmingDelete = false;
    public $search_product_id;

    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
    ];

    public function mount()
    {
        
    }

    public function render()
    {
        $this->categories = Category::all();
        $query = Product::with('category');

    if ($this->product_id) {
        $query->where('id', $this->product_id);
    }

    $products = $query->paginate(10);

    return view('livewire.products.index', [
        'products' => $products,
    ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    public function store()
    {
        //dd($this->category_id);
        $this->validate();

        Product::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'is_new' => $this->is_new,
            'is_on_sale' => $this->is_on_sale,
            'image' => $this->image ? $this->image->store('category', 'public') : null,
        ]);

        $this->mode = 'index';
        session()->flash('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $this->selectedProduct = Product::with('category')->findOrFail($id);
        $this->image = $this->selectedProduct->image;

        $this->mode = 'show';
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
        $this->is_new = $product->is_new;
        $this->is_on_sale = $product->is_on_sale;
        $this->image = $product->image;

        $this->mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'slug' => "required|string|max:255|unique:products,slug,{$this->product_id}",
        ]);

        $product = Product::findOrFail($this->product_id);
        $product->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'is_new' => $this->is_new,
            'is_on_sale' => $this->is_on_sale,
            'image' => $this->image ? $this->image->store('category', 'public') : $product->image,
        ]);

        $this->mode = 'index';
        session()->flash('success', 'Product updated successfully!');
    }

    public function confirmDelete($id)
    {
        $this->product_id = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        Product::destroy($this->product_id);
        $this->confirmingDelete = false;
        session()->flash('success', 'Product deleted successfully!');

    }

    private function resetForm()
    {
        $this->reset([
            'name', 'slug', 'description', 'price', 'stock',
            'category_id', 'is_active', 'is_featured', 'is_new',
            'is_on_sale', 'product_id', 'selectedProduct',
            'image',
        ]);
    }
}
